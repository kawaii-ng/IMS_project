<?php

include_once('../config/db-connection.php');
session_start();

function getSize($pid) {

    global $connect;

    $allSize = array();

    $getSizeSQL = "
        select size from stock
        where productID = '".$pid."'
        group by size
    ";

    if($getSizeQ = mysqli_query($connect, $getSizeSQL)){

        echo "OK";

    }else {

        echo "fail";

    }

    $counter = 0;
    while($size = mysqli_fetch_assoc($getSizeQ)){
        
        $allSize[$counter] = $size;
        $counter++;

    }

    return $allSize;


}

function getColor($pid) {

    global $connect;
    $allColor = array(); 

    $getColorSQL = "
        select color.colorID, color.colorCode from stock, color
        where stock.productID = '".$pid."'
        AND stock.colorID = color.colorID
        group by stock.colorID
    ";

    if($getColorQ = mysqli_query($connect, $getColorSQL)){

        echo "ok";

        $counter = 0;

        while($color = mysqli_fetch_assoc($getColorQ)){

            $allColor[$counter] = $color;
            $counter++;
    
        }

    }else{

        echo "get color fail\n";

    }

    return $allColor;

}

if(isset($_GET['op']) && $_GET['op'] == 'update_qty'){


    $updateSQL = "
    
        UPDATE `stock` 
        SET `stockQuantity`='".$_POST['newQty']."' 
        WHERE stockID = ".$_POST['stockID']."
    
    ";

    if(mysqli_query($connect, $updateSQL)){

        header('Location: /project/public/dashboard-page.php?page=stock_checking&table=inventory&status=updated');

    }else {

        header("Location: /project/public/dashboard-page.php?page=stock_checking&table=inventory&status=error");

    }

    

}

if(isset($_GET['op']) && $_GET['op'] == 'update_product'){

    // get all data from html form first

    $newName = $_POST['newName'];
    $newDes = $_POST['newDes'];
    // new Type later
    $newGender = $_POST['newGender'];
    $newPrice = $_POST['newPrice'];
    $sizeArr = array();
    if(isset($_POST['productID']))
        $pid = $_POST['productID'];
    if(isset($_POST['xxl']))
        array_push($sizeArr, 'XXL');
    if(isset($_POST['xl']))
        array_push($sizeArr, 'XL');
    if(isset($_POST['l']))
        array_push($sizeArr, 'L');
    if(isset($_POST['m']))
        array_push($sizeArr, 'M');
    if(isset($_POST['s']))
        array_push($sizeArr, 'S');
    if(isset($_POST['xs']))
        array_push($sizeArr, 'XS');
    if(isset($_POST['xxs']))
        array_push($sizeArr, 'XXS');
    $newColors = $_POST['newColors'];
    
    if($_POST['submitType'] == 'Update'){

        // if user is updating 

        // do update the product basic info first

        $newImgName = $_FILES['newImg']['name'];
        $imgTMP = $_FILES['newImg']['tmp_name'];
        $imgEX = strtolower(pathinfo($newImgName, PATHINFO_EXTENSION));
        $imgPath = "../uploads/product/" . $newImgName;
        
        if(!$newImgName){

            $imgPath = "\'\'";

        }

        move_uploaded_file($imgTMP, $imgPath);

        $updateSQL = "
        
            UPDATE `product` 
            SET 
            `productName`='".$newName."',
            `productDescription`='".$newDes."',
            `productGender`='".$newGender."',
            `productPrice`='".$newPrice."',
            `productImage`='".$imgPath."'
            WHERE `productID` = '".$pid."'
        ";

        echo 'imgPath: \n'.$imgPath;

        if(mysqli_query($connect, $updateSQL)){

            echo "OK";

        }else {

            echo "Fail";

        }

        // then, get all the size and delete the stock record which are needed to remove

        $allSizeArr = getSize($pid);

        echo "<br>allSizeArr:<br>";
        var_dump($allSizeArr);
        echo "<br>";
        echo "sizeArr:<br>";
        var_dump($sizeArr);
        echo "<br>";

        for ($i = 0; $i < count($allSizeArr); $i++){

            $index = array_search($allSizeArr[$i]['size'], $sizeArr);
            echo "$index<br>";

            if($index === false){

                // delete

                echo "delete" . $allSizeArr[$i]['size'] . "<br>";

                // updatae the status in cart table 
                // if pending -> invalid
                // if purchased -> refunding  
                $cartSQL = "
                    UPDATE cart, stock 
                    SET cart.status = CASE
                        WHEN cart.status = 'pending' THEN 'invalid'
                        WHEN cart.status = 'purchased' THEN 'refunding'
                        ELSE cart.status
                        END
                    WHERE cart.stockID = stock.stockID
                    AND stock.productID = '".$pid."'
                    AND size = '".$allSizeArr[$i]['size']."'                     
                ";

                if(mysqli_query($connect, $cartSQL)){

                    echo "OK";

                }else {

                    echo "update SQL fail";

                }

                // delete the extra stock from the stock table
                $deleteSQL = "
                
                    DELETE FROM `stock` 
                    WHERE productID = '".$pid. "'
                    AND size = '".$allSizeArr[$i]['size']."'
                
                ";
                
                if(mysqli_query($connect, $deleteSQL)){
                    
                    echo "OK";
                    
                    
                }else {
                        
                    echo "delelte size fail\n";
                        
                }
                        
            }else{
                        
                //remove from array
                echo "remove from list: " . $sizeArr[$index] . "<br>";
                $sizeArr[$index] = "";

            }

        }

        $allColorArr = getColor($pid);

        echo "<br>allColorArr:<br>";
        var_dump($allColorArr);
        echo "<br>";
        echo "newColors:<br>";
        var_dump($newColors);
        echo "<br>";

        for($i = 0; $i < count($allColorArr); $i++){

            $index = array_search($allColorArr[$i]['colorCode'], $newColors);
            echo "index: $index<br>";

            if($index === false){

                // updatae the status in cart table 
                // if pending -> invalid
                // if purchased -> refunding  
                $cartSQL = "
                    UPDATE cart, stock 
                    SET cart.status = CASE
                        WHEN cart.status = 'pending' THEN 'invalid'
                        WHEN cart.status = 'purchased' THEN 'refunding'
                        ELSE cart.status
                        END
                    WHERE cart.stockID = stock.stockID
                    AND stock.productID = '".$pid."'
                    AND colorID = '".$allColorArr[$i]['colorID']."'                     
                ";

                if(mysqli_query($connect, $cartSQL)){

                    echo "OK";

                }else {

                    echo "update SQL fail";

                }
                
                $deleteSQL = "
                
                    DELETE FROM `stock` 
                    WHERE productID = '".$pid. "'
                    AND colorID = '".$allColorArr[$i]['colorID']."'
                
                ";

                if(mysqli_query($connect, $deleteSQL)){

                    echo"ok";

                }else{

                    echo "delete color fail\n";

                }

                echo "detete color: " . $allColorArr[$i]['colorCode'] . "<br>";

            }else{

                echo "remove from list: " .  $newColors[$index] . "<br>";
                $newColors[$index] = "";

            }

        }

        for($i = 0; $i < count($newColors); $i++ ){

            if($newColors[$i] != ""){

                $newColorSQL = "
                    INSERT INTO `color`(`colorID`, `colorCode`) VALUES (NULL,'".$newColors[$i]."')
                ";

                if(mysqli_query($connect, $newColorSQL)){

                    echo "ok";

                }else {

                    echo 'add new color fail\n';

                }

                $newColorID = mysqli_insert_id($connect);


                echo "add new color: ". $newColors[$i]. "<br>";
                $allSizeArr = getSize($pid);
                echo "into the size : <br>"; 
                var_dump($allSizeArr);
                echo "<br>";


                for($j = 0; $j < count($allSizeArr); $j++){

                    $newColorSQL = "
                        INSERT INTO `stock`(
                            `stockID`, `productID`, `colorID`, `size`, `stockQuantity`
                        ) VALUES (
                            NULL,'".$pid."','".$newColorID."','".$allSizeArr[$j]['size']."','0'
                        )
                    ";

                    if(mysqli_query($connect, $newColorSQL)){

                        echo 'ok';

                    }else {

                        echo 'add new color fail\n';

                    }

                    echo $allSizeArr[$j]['size'];
                    echo "add ".$newColors[$i]." into ". $allSizeArr[$j]['size'] . "<br>";

                }

            }

        }

        echo "sizeArr: <br>";
        var_dump($sizeArr);
        echo "<br>";

        for($i = 0; $i < count($sizeArr); $i++){

            echo "$i : $sizeArr[$i]<br>";

            if($sizeArr[$i] != ""){

               $allColorArr = getColor($pid);
               var_dump($allColorArr);
               echo "<br>";
               
               for($j = 0; $j < count($allColorArr); $j++){

                    $newSizeSQL = "
                        INSERT INTO `stock`(
                            `stockID`, `productID`, `colorID`, `size`, `stockQuantity`
                        ) VALUES (
                            NULL,'".$pid."','".$allColorArr[$j]['colorID']."','".$sizeArr[$i]."','0'
                        )
                    ";

                    if(mysqli_query($connect, $newSizeSQL)){

                        echo 'ok';

                    }else {

                        echo 'add new size fail\n';

                    }

                    echo "add new size: " .$sizeArr[$i]. " to " .$allColorArr[$j]['colorCode'] . "<br>";

               }

            }

        }

        header("Location: /project/public/dashboard-page.php?page=stock_checking&table=category");


    }else if($_POST['submitType'] == 'Add'){

        $newImgName = $_FILES['newImg']['name'];
        $imgTMP = $_FILES['newImg']['tmp_name'];
        $imgEX = strtolower(pathinfo($newImgName, PATHINFO_EXTENSION));
        $imgPath = "../uploads/product/" . $newImgName;
        
        if(!$newImgName){

            $imgPath = "\'\'";

        }

        move_uploaded_file($imgTMP, $imgPath);

        $addSQL = "
            INSERT INTO `product`(
                `productID`, `productName`, `productType`, 
                `productDescription`, `productGender`, 
                `productPrice`, `productImage`
            ) VALUES (
                NULL,'".$newName."','',
                '".$newDes."','".$newGender."',
                '".$newPrice."','".$imgPath."')
        ";

        $lastID = NULL;

        if(mysqli_query($connect, $addSQL)){

            echo "OK";
            $lastID = mysqli_insert_id($connect);

            for($i = 0; $i < count($newColors); $i++){

                $addColorSQL = "
                    INSERT INTO `color`(
                        `colorID`, `colorCode`
                    ) VALUES (
                        NULL,'".$newColors[$i]."'
                    )
                ";

                if($addColorQ = mysqli_query($connect, $addColorSQL)){

                    echo "Insert color OK   ";

                }else{

                    echo "Insert color Fail   ";

                }
                $colorID = mysqli_insert_id($connect);

                for($j = 0; $j < count($sizeArr); $j++){

                    $addStockSQL = "
                        INSERT INTO `stock`(
                            `stockID`, `productID`, `colorID`, 
                            `size`, `stockQuantity`
                        ) VALUES (
                            NULL, '".$lastID."','".$colorID."',
                            '".$sizeArr[$j]."','0'
                        )
                    
                    ";

                    if($addStockQ = mysqli_query($connect, $addStockSQL)){

                        echo "ADD stock OK    ";

                    }else {

                        echo "ADD stock Fail   ";

                    }

                }

            }

            //header("Location: /project/public/dashboard-page.php?page=stock_checking&table=category");


        }else {

            echo "fail";
            // redirect
            header("Location: /project/public/dashboard-page.php?page=stock_checking&table=category?error=fail_to_update");


        }



    }else{

        // error
        // need redirect

    }

}

if(isset($_POST['op']) && $_POST['op'] == 'delete_product'){

    $pid = $_POST['id'];
    $deleteSQL = "
    
        delete from `product`
        where productID = '".$pid."'
    
    ";

    if(mysqli_query($connect, $deleteSQL)){

        // updatae the status in cart table 
        // if pending -> invalid
        // if purchased -> refunding  
        $cartSQL = "
            UPDATE cart, stock 
            SET cart.status = CASE
                WHEN cart.status = 'pending' THEN 'invalid'
                WHEN cart.status = 'purchased' THEN 'refunding'
                ELSE cart.status
                END
            WHERE cart.stockID = stock.stockID
            AND stock.productID = '".$pid."'                  
        ";

        if(mysqli_query($connect, $cartSQL)){

            echo "OK";

        }else {

            echo "update SQL fail";

        }
    
        header('Location: /project/public/dashboard-page.php?page=stock_checking&table=category&status=updated');
    
    }else {

        header('Location: /project/public/dashboard-page.php?page=stock_checking&table=category&status=error');

    }

}

?>
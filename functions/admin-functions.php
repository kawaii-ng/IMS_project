<?php

include_once('../config/db-connection.php');
session_start();

function getSize($pid) {

    global $connect;

    $allSize;

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

    while($size = mysqli_fetch_assoc($getSizeQ)){
        
        $allSize[] = $size;
    
    }

    return $allSize;


}

function getColor($pid) {

    global $connect;
    $allColor; 

    $getColorSQL = "
        select color.colorID, color.colorCode from stock, color
        where stock.productID = '".$pid."'
        AND stock.colorID = color.colorID
        group by stock.colorID
    ";

    if($getColorQ = mysqli_query($connect, $getColorSQL)){

        echo "ok";

        while($color = mysqli_fetch_assoc($getColorQ)){

            $allColor[] = $color;
    
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

        $updateSQL = "
        
            UPDATE `product` 
            SET 
            `productName`='".$newName."',
            `productDescription`='".$newDes."',
            `productGender`='".$newGender."',
            `productPrice`='".$newPrice."'
            WHERE `productID` = '".$pid."'

        ";

        if(mysqli_query($connect, $updateSQL)){

            echo "OK";

        }else {

            echo "Fail";

        }

        $allSizeArr = getSize($pid);

        for ($i = 0; $i < count($allSizeArr); $i++){

            $index = array_search($allSizeArr[$i], $sizeArr);

            if($index != false){

                // delete
                $deleteSQL = "
                
                    DELETE FROM `stock` 
                    WHERE productID = '".$pid. "'
                    AND size = '".$allSizeArr[$i]."'
                
                ";

                if(mysqli_query($connect, $deleteSQL)){

                    echo"OK";


                }else {

                    echo"delelte size fail\n";

                }

            }else{

                // remove from array
                $sizeArr[$index] = "";

            }

        }

        $allColorArr = getColor($pid);

        for($i = 0; $i < count($allColorArr); $i++){

            $index = array_search($allColorArr[$i]['colorCode'], $newColors);
            if($index != false){
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

            }else{

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

                $allSizeArr = getSize($pid);

                for($i = 0; $i < count($allSizeArr); $i++){

                    $newColorSQL = "
                        INSERT INTO `stock`(
                            `stockID`, `productID`, `colorID`, `size`, `stockQuantity`
                        ) VALUES (
                            NULL,'".$pid."','".$newColorID."','".$allSizeArr[$i]['size']."','0'
                        )
                    ";

                    if(mysqli_query($connect, $newColorSQL)){

                        echo 'ok';

                    }else {

                        echo 'add new color fail\n';

                    }

                }

            }

        }

        for($i = 0; $i < count($sizeArr); $i++){

            if($sizeArr[$i] != ""){

               $allColorArr = getColor($pid);
               
               for($i = 0; $i < count($allColorArr); $i++){

                    $newSizeSQL = "
                        INSERT INTO `stock`(
                            `stockID`, `productID`, `colorID`, `size`, `stockQuantity`
                        ) VALUES (
                            NULL,'".$pid."','".$allColorArr[$i]['colorID']."','".$sizeArr[$i]."','0'
                        )
                    ";

                    if(mysqli_query($connect, $newSizeSQL)){

                        echo 'ok';

                    }else {

                        echo 'add new size fail\n';

                    }

               }

            }

        }

        header("Location: /project/public/dashboard-page.php?page=stock_checking&table=category");


    }else if($_POST['submitType'] == 'Add'){

        $addSQL = "
            INSERT INTO `product`(
                `productID`, `productName`, `productType`, 
                `productDescription`, `productGender`, 
                `productPrice`, `productImage`
            ) VALUES (
                NULL,'".$newName."','',
                '".$newDes."','".$newGender."',
                '".$newPrice."','')
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

            header("Location: /project/public/dashboard-page.php?page=stock_checking&table=category");


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
    
        header('Location: /project/public/dashboard-page.php?page=stock_checking&table=category&status=updated');
    
    }else {

        header('Location: /project/public/dashboard-page.php?page=stock_checking&table=category&status=error');

    }

}

?>
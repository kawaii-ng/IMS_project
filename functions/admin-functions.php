<?php

/*
 * To perform the admin function, including update stock, add stock, delete stock, 
*/

include_once('../config/db-connection.php');
session_start();

// function to get all the size list from the database
function getSize($pid) {

    global $connect;

    $allSize = array();

    $getSizeSQL = "
        select size from stock
        where productID = '".$pid."'
        group by size
    ";

    if($getSizeQ = mysqli_query($connect, $getSizeSQL)){

        $counter = 0;
        while($size = mysqli_fetch_assoc($getSizeQ)){
            
            $allSize[$counter] = $size;
            $counter++;

        }
    }

    return $allSize;


}

// function to get all the color list from the database
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

        $counter = 0;

        while($color = mysqli_fetch_assoc($getColorQ)){

            $allColor[$counter] = $color;
            $counter++;
    
        }

    }

    return $allColor;

}

// function to update the product details 
function updateProductDetail($pid, $newName, $newDes, $newType, $newGender, $newPrice, $sizeArr, $newColors){

    global $connect;

    // if user is updating 

    // do update the product basic info first

    $newImgName = $_FILES['newImg']['name'];
    $imgTMP = $_FILES['newImg']['tmp_name'];
    $imgEX = strtolower(pathinfo($newImgName, PATHINFO_EXTENSION));
    $imgPath = "../uploads/product/" . $newImgName;

    if(!preg_match("/png|jpg|jpeg/i", $imgEX)){

        $updateSQL = "
    
            UPDATE `product` 
            SET 
            `productName`='".$newName."',
            `productType` = '".$newType."',
            `productDescription`='".$newDes."',
            `productGender`='".$newGender."',
            `productPrice`='".$newPrice."'
            WHERE `productID` = '".$pid."'

        ";

        mysqli_query($connect, $updateSQL);

    }else {

        move_uploaded_file($imgTMP, $imgPath);
        $updateSQL = "
    
            UPDATE `product` 
            SET 
            `productName`='".$newName."',
            `productType` = '".$newType."',
            `productDescription`='".$newDes."',
            `productGender`='".$newGender."',
            `productPrice`='".$newPrice."',
            `productImage`='".$imgPath."'
            WHERE `productID` = '".$pid."'
        ";

        mysqli_query($connect, $updateSQL);

    }   

    $deleteSQL = "
    
        delete from stock 
        where productID = '".$pid."'
    
    ";

    if(mysqli_query($connect, $deleteSQL)){

        echo "ok";

    }else{

        echo "fail";

    }

    // update color first (It is hard to remove color table in current stage)

    $newColorList = array();

    for($i = 0; $i < count($newColors); $i++){

            $newColorSQL = "
                INSERT INTO `color`(`colorID`, `colorCode`) VALUES (NULL,'".$newColors[$i]."')
            ";

            mysqli_query($connect, $newColorSQL);
            $newColorID = mysqli_insert_id($connect);
            array_push($newColorList, $newColorID);

    }

    // update the stocks 
    for($i = 0; $i < count($sizeArr); $i++){

        for($j = 0; $j < count($newColorList); $j++){

            $updateSQL = "
                INSERT INTO `stock`(
                    `stockID`, `productID`, `colorID`,
                    `size`, `stockQuantity`
                ) VALUES (
                    NULL,'".$pid."','".$newColorList[$j]."',
                    '".$sizeArr[$i]."','0'
                )
            ";

            mysqli_query($connect, $updateSQL);

        }

    }

    header("Location: /project/public/dashboard-page.php?page=stock_checking&table=category");

}


// function to update quantity of stock
function updateQTY(){

    global $connect;

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

// function to delete a product from the database
function deleteProduct(){

    global $connect;

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

        mysqli_query($connect, $cartSQL);
    
        header('Location: /project/public/dashboard-page.php?page=stock_checking&table=category&status=updated');
    
    }else {

        header('Location: /project/public/dashboard-page.php?page=stock_checking&table=category&status=error');

    }

}

// function to add new product into the database
function addProduct($newName, $newDes, $newType, $newGender, $newPrice, $sizeArr, $newColors){

    global $connect;

    $newImgName = $_FILES['newImg']['name'];
    $imgTMP = $_FILES['newImg']['tmp_name'];
    $imgEX = strtolower(pathinfo($newImgName, PATHINFO_EXTENSION));
    $imgPath = "../uploads/product/" . $newImgName;
    
    if(!preg_match("/png|jpg|jpeg/i", $imgEX)){

        $imgPath = "https://www.svgrepo.com/show/260897/polo-fashion.svg";

    }else {

        move_uploaded_file($imgTMP, $imgPath);

    }

    $addSQL = "
        INSERT INTO `product`(
            `productID`, `productName`, `productType`, 
            `productDescription`, `productGender`, 
            `productPrice`, `productImage`
        ) VALUES (
            NULL,'".$newName."','".$newType."',
            '".$newDes."','".$newGender."',
            '".$newPrice."','".$imgPath."')
    ";

    $lastID = NULL;



    if(mysqli_query($connect, $addSQL)){

        $lastID = mysqli_insert_id($connect);

        for($i = 0; $i < count($newColors); $i++){

            $addColorSQL = "
                INSERT INTO `color`(
                    `colorID`, `colorCode`
                ) VALUES (
                    NULL,'".$newColors[$i]."'
                )
            ";

            $addColorQ = mysqli_query($connect, $addColorSQL);
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

                $addStockQ = mysqli_query($connect, $addStockSQL);

            }

        }

        header("Location: /project/public/dashboard-page.php?page=stock_checking&table=category");


    }else {

        echo mysqli_error($connect);
        echo "fail";
        // redirect
        header("Location: /project/public/dashboard-page.php?page=stock_checking&table=category?error=fail_to_update");


    }

}

// function to update the product details
function updateProduct() {

    global $connect;

    // get all data from html form first

    $newName = $_POST['newName'];
    $newDes = $_POST['newDes'];
    $newType = $_POST['newType'];
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

    if($_POST['submitType'] == 'Update')
        updateProductDetail($pid, $newName, $newDes, $newType, $newGender, $newPrice, $sizeArr, $newColors);

    if($_POST['submitType'] == 'Add')
        addProduct($newName, $newDes, $newType, $newGender, $newPrice, $sizeArr, $newColors);

}

// determine which operation needs to perform 
if(isset($_POST['op']) && $_POST['op'] == 'delete_product')
    deleteProduct();

if(isset($_POST['op']) && $_POST['op'] == 'update_qty')
    updateQTY();    

if(isset($_GET['op']) && $_GET['op'] == 'update_product')
    updateProduct();


?>
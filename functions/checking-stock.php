<?php

include_once('../config/db-connection.php');
session_start();

if($_POST['op'] == 'check_stock'){

    $id = $_POST['id'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $qty = $_POST['qty'];

    $checkStockSQL = "

        select stockQuantity from stock
        where productID = '".$id."'
        and colorID = '".$color."'
        and size = '".$size."'
    
    ";

    if($checkStockQ = mysqli_query($connect, $checkStockSQL)){

        while($currentQty = mysqli_fetch_assoc($checkStockQ)){

            if($qty <= $currentQty['stockQuantity']){

                echo 'true';
    
            }else {
                echo 'false';
            }

        }

       //echo "<p>fretch fail</p>";

    }else {

        echo "false";

    }

}else{

    echo "false";

}

?>
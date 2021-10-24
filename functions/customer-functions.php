<?php

    session_start();
    include_once('../config/db-connection.php');

    if($_GET['op'] == 'add_to_cart'){

        $stockSQL = "
        
            Select stockID, stockQuantity from stock 
            where productID = '".$_POST['productID']."'
            and size = '".$_POST['size']."'
            and colorID = '".$_POST['color']."'
        
        ";

        if($stockQ = mysqli_query($connect, $stockSQL)){

            $stock = mysqli_fetch_assoc($stockQ);

            $cartSQL = "
            
                insert into `cart` (

                    `cartID`, `userID`, `stockID`, `quantity`, `status`

                ) values (

                    NULL,
                    '".$_SESSION['userID']."',
                    '".$stock['stockID']."',
                    '".$_POST['qty']."',
                    'pending'

                )
            
            ";

            if($stock['stockQuantity'] >= $_POST['qty']){

                if($cartQ = mysqli_query($connect, $cartSQL)){

                    // insert successfully
                    header("Location: /project/public/customer-page.php?page=products");
    
                }else {
    
                    // fail to insert
                    header("Location: /project/public/customer-page.php?page=products&error=true");
    
                }    

            }else {

                // not enough stock
                //header("Location: ");
                echo "no stock";

            }

        }

    }

    if($_GET['op'] == 'remove_cart'){

        $cartSQL = "
        
            delete from cart
            where cartID = '".$_POST['cart-ID']."'
        
        ";

        if(mysqli_query($connect, $cartSQL)){

            header("Location: /project/public/customer-page.php?page=shopping_cart");


        }else{

            header("Location: /project/public/customer-page.php?page=shopping_cart&error=delete_fail");

        }

    }

?>
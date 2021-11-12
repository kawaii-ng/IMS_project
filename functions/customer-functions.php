<?php

    session_start();
    include_once('../config/db-connection.php');

    if($_GET['op'] == 'update_profile'){
    
        $newImgName = $_FILES['newProfileImg']['name'];
        $imgTMP = $_FILES['newProfileImg']['tmp_name'];
        $imgEX = strtolower(pathinfo($newImgName, PATHINFO_EXTENSION));
        $imgPath = "../uploads/profile/" . $newImgName;
        
        if(!$newImgName){

            $imgPath = "\'\'";

        }

        move_uploaded_file($imgTMP, $imgPath);

        if($_POST['nickName'] != ""){

            $updateNameSQL = "
    
                UPDATE `user` SET userName = '".$_POST['nickName']."'
                WHERE userID = '".$_POST['userID']."'
            
            ";

            $updateNameQ = mysqli_query($connect, $updateNameSQL);

        }
        
        if($imgPath != "\'\'"){

            $imgPathSQL = "
    
                UPDATE `user` SET icon = '".$imgPath."'
                WHERE userID = '".$_POST['userID']."'
            
            ";

            $imgPathQ = mysqli_query($connect, $imgPathSQL);

        }

        if($_POST['email'] != ''){

            $newEmailSQL = "
    
                UPDATE `user` SET email = '".$_POST['email']."'
                WHERE userID = '".$_POST['userID']."'
            
            ";

            $newEmailQ = mysqli_query($connect, $newEmailSQL);


        }

        if($_POST['password'] != ""){

            $newPwSQL = "
    
                UPDATE `user` SET password = '".$_POST['password']."'
                WHERE userID = '".$_POST['userID']."'
            
            ";

            $newPwQ = mysqli_query($connect, $newPwSQL);

        }


        $newGenderSQL = "

            UPDATE `user` SET gender = '".$_POST['gender']."'
            WHERE userID = '".$_POST['userID']."'
        
        ";

        $newGenderQ = mysqli_query($connect, $newGenderSQL);

        header("Location: /project/public/dashboard-page.php?page=profile");

    }


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
                    '".$_POST['productQty']."',
                    'pending'

                )
            
            ";

            if($stock['stockQuantity'] >= $_POST['productQty']){

                if($cartQ = mysqli_query($connect, $cartSQL)){

                    // insert successfully
                    header("Location: /project/public/dashboard-page.php?page=products");
    
                }else {
    
                    // fail to insert
                    header("Location: /project/public/dashboard-page.php?page=products&error=true");
    
                }    

            }else {

                // not enough stock
                //header("Location: ");
                echo "no stock";

            }

        }

    }

    if(isset($_GET['op']) && $_GET['op'] == 'remove_cart'){

        $cartSQL = "
        
            delete from cart
            where cartID = '".$_POST['cart-ID']."'
        
        ";

        if(mysqli_query($connect, $cartSQL)){

            header("Location: /project/public/dashboard-page.php?page=shopping_cart");


        }else{

            header("Location: /project/public/dashboard-page.php?page=shopping_cart&error=delete_fail");

        }

    }

?>
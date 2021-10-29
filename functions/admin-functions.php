<?php

include_once('../config/db-connection.php');
session_start();

if($_GET['op'] == 'update_qty'){


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

?>
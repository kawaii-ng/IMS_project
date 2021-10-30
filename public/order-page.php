<div class="content">
        
    <div id="top"></div>

    <div class="fab-group">        
        <a class='fab' href='#top'>
            <i class='fas fa-arrow-up'></i>
        </a>
    </div>

    <?php 
    
        include_once('./title-bar.php');
    
    ?>

    <div class='content'>

    <?php
    
        include_once('../config/db-connection.php');

        if(isset($_GET['search_id'])){

            $orderSQL = "
            
                SELECT * FROM `cart`, `user`
                WHERE cart.userID = user.userID
                AND user.userID = '".$_GET['search_id']."'
            
            ";
    
            $orderQ = mysqli_query($connect, $orderSQL);
    
            

        }else if(isset($_GET['asc_order'])) {

            $orderSQL = "
            
                SELECT * FROM `cart`, `user`
                WHERE cart.userID = user.userID
                ORDER BY user.userName ASC
        
            ";

            $orderQ = mysqli_query($connect, $orderSQL);

        
        }else{


            $orderSQL = "
            
            SELECT * FROM `cart`, `user`
            WHERE cart.userID = user.userID
        
            ";

            $orderQ = mysqli_query($connect, $orderSQL);
            

        }

?>

        <table class='my-table'>

            <tr>
                <th>Cart ID</th>
                <th>User ID</th>
                <th>User Name</th>
                <th>Stock ID</th>
                <th>Qty</th>
                <th>Status</th>
            </tr>

<?php
        while($order = mysqli_fetch_assoc($orderQ)){
    
            echo "
            <tr>
                <td>".$order['cartID']."</td>
                <td>".$order['userID']."</td>
                <td>".$order['userName']."</td>
                <td>".$order['stockID']."</td>
                <td>".$order['quantity']."</td>
                <td>".$order['status']."</td>
            </tr>
            ";

        }
    
    ?>
        </table>

    </div>

</div>
<div class="shopping-cart-section">
        
    <div id="top"></div>

    <div class="fab-group">        
        <a class='fab' href='#top'>
            <i class='fas fa-arrow-up'></i>
        </a>
    </div>

    <div class='cart-bar'>
        <h3>Order</h3>
        <div class='search-container'>
            <form action="/project/public/dashboard-page.php" method="get">
                <label for="">User ID: </label>
                <input type="hidden" name='page' value='order'>
                <input type="text" name='search_id'>
                <input type="submit" value="Search">
            </form>
            <form action="/project/public/dashboard-page.php" method="get">
                <input type="hidden" name='page' value='order'>
                <input type="submit" name='asc_order' value="Ascending">
            </form>
        </div>
    </div>

    <div class='cart'>

    <?php
    
        include_once('../config/db-connection.php');

        if(isset($_GET['search_id'])){

            $orderSQL = "
            
                SELECT * FROM `cart`, `user`
                WHERE cart.userID = user.userID
                AND userID = '".$_GET['search_id']."'
            
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

        <table class='stock-table'>

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
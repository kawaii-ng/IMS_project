<div class='content'>

    <?php

        include_once("../config/db-connection.php");
        
        $orderSQL = "
        
            SELECT * FROM `cart`, `stock`, `product`
            WHERE cart.userID = '".$_SESSION['userID']."' and cart.status = 'pending'
            and cart.stockID = stock.stockID
            and stock.productID = product.productID

        ";
        
        $orderQ = mysqli_query($connect, $orderSQL);
        
        $totalSQL = "
        
            SELECT sum(productPrice * quantity) as price FROM `cart` , `stock`, `product`
            WHERE cart.userID = '".$_SESSION['userID']."' and cart.status = 'pending'
            and cart.stockID = stock.stockID
            and stock.productID = product.productID
        
        ";
        
        $totalQ = mysqli_query($connect, $totalSQL);
        $total = mysqli_fetch_assoc($totalQ);

        $hasOrder = false;

        $_SESSION['totalPrice'] = $total['price']? $total['price']: 0;
        
        echo "
        <form method='post' name='cartForm' action='/project/functions/customer-functions.php?op=update_cart'>
        
        <input type='hidden' name='cart-ID' id='cart-ID' value=''>";

        include_once('./title-bar.php');
        
        echo "<div class='content'>
        <div class='order-grid'>";
        
        while($order = mysqli_fetch_assoc($orderQ)){

            $hasOrder = true;
            
            $colorSQL = "
            
                select colorCode from color
                where colorID = ".$order['colorID']."
            
            ";
            
            $color = mysqli_fetch_assoc(mysqli_query($connect, $colorSQL));
            include_once("./remove-modal.php");
            include_once('./purchase-modal.php');

            echo "<div class='order-card' id='order-".$order['cartID']."'>
            
                <div class='order-img'>
                    <img src='".$order['productImage']."'/>
                </div>

                <div class='order-content'>
                
                    <small>".$order['stockID']."</small>
                    <h3>".$order['productName']."</h3>
                    <table>
                        <tr>
                            <th>QTY:</th>
                            <td>".$order['quantity']."</td>
                            <th>Color:</th>
                            <td><div class='color' style='background: ".$color['colorCode']."'></div></td>
                        </tr>
                        <tr>
                            <th>Size:</th>
                            <td>".$order['size']."</td>
                            <th>Price:</th>
                            <td>HK$".$order['productPrice']."</td>
                        </tr>
                    </table>

                    <div class='btn-group'>
                        
                        <input type='button' name='actionType' id='remove-".$order['cartID']."' class='btn del-btn' value='Remove'/>
                    </div>

                </div>
            
            </div>
            </form>
            ";

// <button class='btn edit-btn'>Edit</button>
//<input type='button' class='btn edit-btn' id='purchase-".$order['cartID']."' value='Purchase'/>
        }

        if(!$hasOrder){

            echo "
            <i class='fas fa-socks no-cloth-icon'></i>
            <p class='no-cloth-msg'>It seems that you haven't buy any cloth yet. <br>
            <a href='/project/public/dashboard-page.php?page=products'>Let's purchase some clothes now.</a> 
            </p>";

        }
    
    ?>

    </div>

    </div>

</div>
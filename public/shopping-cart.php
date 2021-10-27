<div class='shopping-cart-section'>

    <?php

        include_once("../config/db-connection.php");
        
        $orderSQL = "
        
            SELECT * FROM `cart` , `stock`, `product`
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

        $totalPrice = $total['price']? $total['price']: 0;
        
        echo "
        <form method='post' name='cartForm' action='/project/functions/customer-functions.php?op=remove_cart'>
        
        <input type='hidden' name='cart-ID' id='cart-ID' value=''>
        
        <div class='cart-bar'>
        <h3>My Shopping Cart</h3>
        <div>
        <strong>Total: HK$" .  $totalPrice ."</strong> 
                <button class='btn buy-btn'>Buy all</button>
                </div>
        </div>
        <div class='cart'>";
        
        while($order = mysqli_fetch_assoc($orderQ)){
            
            $hasOrder = true;
            
            $colorSQL = "
            
            select colorCode from color
            where colorID = ".$order['colorID']."
            
            ";
            
            $color = mysqli_fetch_assoc(mysqli_query($connect, $colorSQL));
            include_once("./remove-modal.php");

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
                        <button class='btn edit-btn'>Edit</button>
                        <input type='button' id='remove-".$order['cartID']."' class='btn del-btn' value='Remove'/>
                    </div>

                </div>
            
            </div>
            </form>
            ";



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
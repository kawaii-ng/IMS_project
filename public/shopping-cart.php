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

        echo "
        <div class='cart-bar'>
            <h3>My Shopping Cart</h3>
            <div>
                <strong>Total: HK$". $total['price'] ."</strong> 
                <button class='btn buy-btn'>Buy all</button>
            </div>
        </div>
        <div class='cart'>";

        while($order = mysqli_fetch_assoc($orderQ)){

            $hasOrder = true;

            // $productSQL = "
            
            //     select * from stock, product
            //     where stock.productID = product.productID 
            //     and stock.stockID = ".$order['stockID']."
            
            // ";

            // $productQ = mysqli_query($connect, $productSQL);
            // $product = mysqli_fetch_assoc($productQ);

            echo "<div class='order-card'>
            
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
                            <td><div class='color' style='background: black'></div></td>
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
                        <button class='btn del-btn'>Remove</button>
                    </div>

                </div>
            
            </div>";



        }

        if(!$hasOrder){

            echo "
            <i class='fas fa-socks no-cloth-icon'></i>
            <p class='no-cloth-msg'>It seems that you haven't buy any cloth yet. <br>
            <a href='/project/public/customer-page.php?page=products'>Let's purchase some clothes now.</a> 
            </p>";

        }
    
    ?>

    </div>

</div>
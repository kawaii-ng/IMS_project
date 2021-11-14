
<div id="top"></div>

<div class="fab-group">
    <a class="fab" href="#top"><i class="fas fa-arrow-up"></i></a>
</div>
<div class="content">
<?php

    include_once('./title-bar.php');

?>

<div class="product-grid">

    <!-- render the card by getting data from db -->
    <?php 
    
        $productSQL = "Select * from product";
        $productQ = mysqli_query($connect, $productSQL);

        while ($product = mysqli_fetch_assoc($productQ)) {

            echo "
            
                <div class='product-card' id='product-". $product['productID'] ."'>
                    <img class='product-img' src='". $product['productImage'] ."' alt=''>
                    <div class='card-content'>
                        <small class='product-id'>" . $product['productID'] . "</small>
                        <h5 class='product-name'>" . $product['productName'] . "</h5>
                        <h3 class='product-price'>HK$". $product['productPrice'] ."</h3>
                    </div>
                </div>  
            
            ";

        }
    
    ?>

      

</div>
</div>


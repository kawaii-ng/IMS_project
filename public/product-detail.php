<!-- render the modal from the db -->

<?php 

        $productSQL = "Select * from product";
        $productQ = mysqli_query($connect, $productSQL);

        while ($product = mysqli_fetch_assoc($productQ)) {


            $colorSQL = "
            
                Select colorID from stock, product
                where stock.productID = product.productID and stock.productID = ". $product['productID'] ."
                group by colorID

            ";

            $colorQ = mysqli_query($connect, $colorSQL);

            $sizeSQL = "
            
                Select size from stock, product
                where stock.productID = product.productID and stock.productID = ". $product['productID'] ."
                group by size

            ";

            $sizeQ = mysqli_query($connect, $sizeSQL);

            echo "
            
                    <div class='detail-modal' id='product-modal-". $product['productID'] ."'>

                    <i class='close-btn far fa-window-close' id='product-close-" . $product['productID'] . "'></i>
                
                    <form action='/project/functions/customer-functions.php?op=add_to_cart' name='purchaseForm' method='post' class='purchase-form'>
                    <input type='hidden' name='productID' class='pID' value='" . $product['productID'] . "'>
                    <div class='purchase-section'>
                        <div>
                            <strong>
                                <h1>". $product['productName'] ."</h1>
                                <small>". $product['productGender'] ."</small>
                            </strong>
                            <br>
                            <p>". $product['productDescription'] ."</p>
                            <br>
                            <h3>HK$". $product['productPrice'] ."</h3>
                                <div class='counter'>
                                    <a class='count-btn count-add-btn'>
                                        <i class='fas fa-plus-square'></i>
                                    </a>
                                    <input type='number' value='1' min='1' name='productQty' class='count' readonly>
                                    <a class='count-btn count-minus-btn'>
                                        <i class='fas fa-minus-square'></i>
                                    </a>
                                </div>
                                
                                <input id='product-btn-".$product['productID']."' class='my-form-btn' type='button' value='Add to Cart'></input>
                                
                        </div>
                    </div>
                    
                    <div class='detail-section'>
                        <div>
                            <h5>Colors</h5>
                            ";

                            $count = 0;
                            while($color = mysqli_fetch_assoc($colorQ)){

                                $hexSQL = "
                                
                                    select colorCode from color
                                    where colorID = ". $color['colorID'] ."

                                ";

                                if($hexQ = mysqli_query($connect, $hexSQL)){

                                    $hex =  mysqli_fetch_assoc($hexQ);
                                    
                                }   

                                if($count == 0){

                                    echo "<input type='hidden' name='color' class='colorValue' value='".$hex['colorCode']."'>";
                                    
                                }

                                echo "<div class='color";
                                if($count == 0){

                                    echo " color-size-active";
                                    
                                }
                                echo "' style='background:".$hex['colorCode']."'>".$color['colorID']."</div>";
                                $count++;

                            }
                    
                    echo"
                        
                            <br>
                            <h5>Sizes</h5>";

                            $count = 0;
                            while($size = mysqli_fetch_assoc($sizeQ)){

                                if($count == 0){

                                    echo "<input type='hidden' name='size' class='sizeValue' value='".$size['size']."'>";
                                    
                                }

                                echo "<div class='size";
                                if($count == 0){

                                    echo " color-size-active";
                                    
                                }
                                echo "'>". $size['size'] ."</div>";
                                $count++;

                            }

                    echo"
                           
                        </div>
                        
                    </div>
                    </form>
                
                    <div class='img-section'>
                        <img src='".$product['productImage']."' alt=''>
                    </div>
                
                </div>
        
            
            ";

        }

?>


<div id="top"></div>
<div class="content">
    
    <div class="fab-group">
        <div class='fab' id='add-product-btn'>
            <i class='fas fa-plus-square'></i>
        </div>
        
        <a class='fab' href='#top'>
            <i class='fas fa-arrow-up'></i>
        </a>
    </div>

    <div class='edit-modal'></div>

<?php

    include_once('./title-bar.php');

    $stockSQL = "

        select * from stock, product, color
        where stock.productID = product.productID
        and stock.colorID = color.colorID
    
    ";

    $stockQ = mysqli_query($connect, $stockSQL);

    $productSQL = "
    
        select * from product
    
    ";

    $productQ = mysqli_query($connect, $productSQL);


    if($_GET['table'] == 'category'){

        echo "
        <div class=''>
        <table class='my-table'>
            <tr>
                <th></th>
                <th>Product</th>
                <th>Gender</th>
                <th>Price</th>
                <th>Color</th>
                <th>Size</th>
                <th></th>
                <th></th>
            </tr>   
        ";

    }else {

        echo "
        <div class='cart'>
        <table class='my-table'>
            <tr>
                <th></th>
                <th>Product</th>
                <th>Size</th>
                <th>Color</th>
                <th>Qty</th>
                <th></th>
            </tr>   
        ";

    }

    if($_GET['table'] == 'category'){

        while($stock = mysqli_fetch_assoc($productQ)){

            $colorSQL = "
            
                SELECT colorCode FROM `stock`, `color` 
                WHERE stock.colorID = color.colorID
                AND stock.productID = ".$stock['productID']."
                GROUP by stock.productID, stock.colorID;
            
            ";

            $colorQ = mysqli_query($connect,$colorSQL);
            
            $sizeSQL = "
            
                SELECT * FROM `stock`
                WHERE stock.productID = ".$stock['productID']."
                GROUP by stock.productID, stock.size;
            
            ";

            $sizeQ = mysqli_query($connect,$sizeSQL);

            echo "
            
                <tr>
                    <td>
                        <img src='".$stock['productImage']."' alt=''>
                    </td>
                    <td>".$stock['productName']."</td>
                    <td>".$stock['productGender']."</td>
                    <td>HK$".$stock['productPrice']."</td>
                    <td>";
                    
                        while($color = mysqli_fetch_assoc($colorQ)){

                            echo "<div class='color' style='background: ".$color['colorCode']."'></div>";

                        }
                        
                    echo "
                    </td>
                    <td>";

                        while($size = mysqli_fetch_assoc($sizeQ)){

                            echo "<div>".$size['size']."</div>";

                        }

                    echo"
                    </td>
                    <td>
                        <button class='btn edit-btn open-edit-btn' id='open-edit-model-".$stock['productID']."'>Edit</button>
                    </td>
                    <td>
                        <button class='btn del-btn delete-product-btn' id='delete-product-".$stock['productID']."'>Delete</button>
                    </td>
                </tr>
            
            ";
        
        }


    }else {

        while($stock = mysqli_fetch_assoc($stockQ)){

            $stockID = $stock['stockID'];

            echo "

                <form action='/project/functions/admin-functions.php?op=update_qty' 
                        method='post' name='updateQtyFrom'>
                <input name='stockID' id='update-qty-id-".$stockID."' type='hidden' value='".$stockID."'>
                <tr>
                    <td>
                        <img src='".$stock['productImage']."' alt=''>
                    </td>
                    <td>
                        ".$stock['productName']."
                    </td>
                    <td>
                        ".$stock['size']."
                    </td>
                    <td>
                        <input type='hidden' value='".$stock['colorID']."'/>
                        <div class='color' style='background: ".$stock['colorCode']."'></div>
                    </td>
                    <td>
                        <input type='number' name='newQty' id='qty-".$stockID."'
                                value='".$stock['stockQuantity']."'
                                onchange='this.value = Math.abs(this.value)'
                        />
                    </td>
                    <td>
                        <input type='button' name='updateQty' class='btn edit-btn update-qty-btn' value='Update' id='update-qty-".$stockID."' />
                    </td>
                </tr>
            
                </form>
            ";

        }

        include_once('./updated-modal.php');

    }

?>

    
    </table>
    </div>

</div>
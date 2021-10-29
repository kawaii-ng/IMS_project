<div class="shopping-cart-section">
        
    <div id="top"></div>

    <div class="fab-group">
        <div class='fab'>
            <i class='fas fa-plus-square'></i>
        </div>
        
        <a class='fab' href='#top'>
            <i class='fas fa-arrow-up'></i>
        </a>
    </div>

    <div class="cart-bar">
        <h3>Stock</h3>
        <div>
            <button onclick="location.href='/project/public/dashboard-page.php?page=stock_checking&table=category'"
                class="btn buy-btn">
                Category
            </button>
            <button onclick="location.href='/project/public/dashboard-page.php?page=stock_checking&table=inventory'"
                class='btn buy-btn'>
                Inventory
            </button>
        </div>
    </div>

<?php

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
        <div class='cart'>
        <table class='stock-table'>
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
        <table class='stock-table'>
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
                    <td><textarea>".$stock['productName']."</textarea></td>
                    <td>
                        <select>
                            <option value='".$stock['productGender']."'>".$stock['productGender']."</option>
                            ";
                            if($stock['productGender']!="Men")
                                echo "<option value='Men'>Men</option>";
                            if($stock['productGender']!="Women")
                                echo "<option value='Women'>Women</option>";
                            if($stock['productGender']!="Unisex")
                                echo "<option value='Unisex'>Unisex</option>";

                    echo "
                    </select>    
                    </td>
                    <td>HK$<input type='number' value='".$stock['productPrice']."'/>
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
                        <button class='btn edit-btn'>Edit</button>
                    </td>
                    <td>
                        <button class='btn del-btn'>Delete</button>
                    </td>
                </tr>
            
            ";
        
        }


    }else {

        while($stock = mysqli_fetch_assoc($stockQ)){

            echo "

                <form action='/project/functions/admin-functions.php?op=update_qty' 
                        method='post' name='updateQtyFrom'>
                <input name='stockID' type='hidden' value='".$stock['stockID']."'>
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
                        <input type='number' name='newQty' 
                                value='".$stock['stockQuantity']."'
                                onchange='this.value = Math.abs(this.value)'
                        />
                    </td>
                    <td>
                        <button name='updateQty' class='btn edit-btn'>Update</button>
                    </td>
                </tr>
            
                </form>
            ";

        }

    }

?>

    
    </table>
    </div>

</div>
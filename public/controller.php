<?php

include_once('../config/db-connection.php');

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


if($_POST['table'] == 'category'){

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

if($_POST['table'] == 'category'){

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

        echo "
        <form action='/project/functions/admin-functions.php?op=update_qty' 
                method='post' class='update-qty-form' name='updateNewQtyForm' enctype='multipart/form-data'>
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
                        <button name='updateNewQty' id='update-new-qty-btn' class='btn edit-btn update-new-qty-btn'>Update</button>
                    </td>
                </tr>
                    
            </form>
        ";

    }

}
?>
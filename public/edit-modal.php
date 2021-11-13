<div class="">

<?php 

include_once('../config/db-connection.php');

if(isset($_POST['id'])){

    $pid = $_POST['id'];
    $productSQL = "
    
        select * from product
        where productID = '".$pid."'

    ";

    $productQ = mysqli_query($connect, $productSQL);

    $product = mysqli_fetch_assoc($productQ);

}


?>
<!-- /project/functions/admin-functions.php -->

<form action='/project/functions/admin-functions.php?op=update_product' method="post" class='product-form' name="productForm"  enctype="multipart/form-data">

<?php

function isChecked($label){

    global $product;
    global $connect;

    if($_POST['op'] == 'edit_product'){

        $sizeSQL = "
        
            select size from stock
            where productID = '".$product['productID']."'
            group by size
        
        ";

        if($sizeQ = mysqli_query($connect, $sizeSQL)){

            
            while($size = mysqli_fetch_assoc($sizeQ)){

                if($size['size'] == $label){

                    echo "checked";
                    break;

                }
    
            }

        }
        

    }
        

}

function getColor() {

    global $product;
    global $connect;

    if($_POST['op'] == 'edit_product'){

        $colorSQL = "
        
            select colorCode from stock, color
            where stock.productID = '".$product['productID']."' 
            and color.colorID = stock.colorID
            group by stock.colorID
        
        ";
    
        $colorQ = mysqli_query($connect, $colorSQL);
    
        while($color =  mysqli_fetch_assoc($colorQ)){
    
            $newColor = "
                <li class='color-item'>
                    <div class='selected-color' style='background: ".$color['colorCode']."'></div>
                    <input type='hidden' name='newColors[]' class='color-input' value='".$color['colorCode']."'>
                </li>
            
            ";
    
            echo $newColor;
    
        }

    }


}

function fillData($field){

    global $product;

    if($_POST['op'] == 'edit_product')
        echo $product[$field];
    else if($field == 'productImage')
        echo "https://cdn-icons.flaticon.com/png/512/4533/premium/4533754.png?token=exp=1636781807~hmac=3934e632eed8c743be888b915aca3f7c";
    else
        echo "";

}

// function placeSubmitBtn(){

//     echo "<input type='button' name='submitType' value='";

//     if($_POST['op'] == 'edit_product')
//         echo "Update";
//     else
//         echo "Add";

//     ehco "'/>";

// }


?>

<i class='close-btn far fa-window-close' id='close-product-window'></i>
<div class='panel'>
    <div class='panel-container'>
    <h1><?php 

        if($_POST['op'] == 'edit_product')
            echo "Edit Product";
        else 
            echo "Add Product";

    ?></h1>

    <div class='toggle-btn-group'>
        <div class='toggle-btn-1 toggle-btn-active'>Basic Info</div>
        <div class='toggle-btn-2'>Size & Color</div>
    </div>

    <div id='edit-panel-1'>
        <br>
        <h3>Basic Info</h3>
        <input type="hidden" name='productID' value='<?php
            if($_POST['op'] == 'edit_product')
                echo $pid;
        ?>'>
        <label for='new-product-name'>Product Name</label>
        <input type='text' name='newName'id='new-product-name' value='<?php fillData('productName');?>'>
    
        <label for='new-product-des'>Description</label>
        <TextArea name='newDes' id='new-product-des'><?php fillData('productDescription');?></TextArea>
    
        <div class="info-panel">
            <div>
                <label for='new-type'>Type</label>
                <select name='newType' id="new-type">
                    <option value='<?php fillData('productType');?>'><?php fillData('productType');?></option>
                    
                </select>
            </div>
            <div>
                <label for='new-gender'>Gender</label>
                <select name='newGender' id="new-gender">
                    <option value='<?php fillData('productGender');?>'><?php fillData('productGender');?></option>
                    <?php
                        
                        if(isset($product))
                            $gender = $product['productGender'];
                        else
                            $gender = "";
            
                        if($_POST['op'] == "add_product" || $gender != "Women")
                            echo "<option value='Women'>Women</option>";
                        if($_POST['op'] == "add_product" || $gender != "Men")
                            echo "<option value='Men'>Men</option>";
                        if($_POST['op'] == "add_product" || $gender != "Unisex")
                            echo "<option value='Unisex'>Unisex</option>";
                    ?>        
                </select>
            </div>
            <div>
                <label for='new-price'>Price (HK$)</label>
                <br>
                <input type="number" name='newPrice' id='new-price' value='<?php fillData('productPrice');?>'>
            </div>
        </div>
    </div>

    <div id='edit-panel-2'>
        <br>
        <h3>Style & Color</h3>
        <label for="new-size">Size(s)</label>
        <div class='checkbox-container' id='new-size'>
            <input type="checkbox" name="xxl" id='xxl' <?php isChecked('XXL');?>>
            <label for="xxl">XXL</label>
            <input type="checkbox" name="xl" id='xl' <?php isChecked('XL');?>>
            <label for="xl">XL</label>
            <input type="checkbox" name="l" id='l' <?php isChecked('L');?>>
            <label for="l">L</label>
            <input type="checkbox" name="m" id='m' <?php isChecked('M');?>>
            <label for="m">M</label>
            <input type="checkbox" name="s" id='s' <?php isChecked('S');?>>
            <label for="s">S</label>
            <input type="checkbox" name="xs" id='xs' <?php isChecked('XS');?>>
            <label for="xs">XS</label>
            <input type="checkbox" name="xxs" id='xxs' <?php isChecked('XXS');?>>
            <label for="xxs">XXS</label>
        </div>
    
        <label for="color-list">Color(s)</label>

        <div id='color-control-panel'>
            <input type="color" id='product-color-picker'>
            <!-- <input type="text" id='product-color-code' value="#000000" disabled> -->
            <div id='add-color-btn'>Add</div>
        </div>
        <ul class='color-list'>

            <?php
            
                getColor();
            
            ?>

        </ul>
        
    </div>


    <input type="button" name='submitType' id='update-product-btn' value='<?php 
    
    if($_POST['op'] == 'edit_product')
        echo "Update";
    else
        echo "Add";

    ?>'/>
    </div>
    <p class='error' id='new-profile-error'>
        <i class='fas fa-exclamation-circle'></i>
        Profile Image Failed to Upload. Please Try Again.
    </p>
    
</div>

<div class='panel'>
    <label for='new-img-path' class='edit-new-image' id='edit-new-image-btn'>
        <img src='<?php fillData('productImage') ?>' alt="" id='new-product-img' />
    </label>
    <input type="file" name='newImg' id='new-img-path'>
</div>

</form>

</div>
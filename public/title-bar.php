<?php

    if(isset($_POST['page'])){

        switch ($_POST['page']){

            case 'profile':
                echo "<h3>Profile</h3>";
                break;

            case 'products':
                echo "
                    <h3>Tops</h3>
                ";
                break;

            case 'shopping-cart':
                echo"
                    <h3>My Shopping Cart</h3>
                    <div>
                        <strong>Total: HK$" .  $_SESSION['totalPrice'] ."</strong>     
                        <button class='btn buy-btn'>Buy all</button>
                    </div>";
                break;

            case 'stock-checking':
                echo "
                    
                    <h3>Stock</h3>
                    <div>
                        <button id='category-btn' 
                            class=\"btn buy-btn\">
                            Category
                        </button>
                        <button id='inventory-btn' 
                            class='btn buy-btn'>
                            Inventory
                        </button>
                    </div>
                    
                ";
                break;

            case 'order-page':
                echo "
                    
                <h3>Order</h3>
                <div class='search-container'>
                    <form action='/project/public/dashboard-page.php' method='get'>
                        <label for=''>User ID: </label>
                        <input type='hidden' name='page' value='order'>
                        <input type='text' name='search_id'>
                        <button value='Search' class='btn buy-btn'>
                            <i class='fas fa-search'></i>
                        </button>
                    </form>
                    <form action='/project/public/dashboard-page.php' method='get'>
                        <input type='hidden' name='page' value='order'>
                        <button name='asc_order' value='true' class='btn buy-btn'>
                            <i class='fas fa-sort-alpha-down'></i>
                        </button>
                    </form>
                </div>
                    
                ";
                break;

            default:
                break;

        }

    }

?>



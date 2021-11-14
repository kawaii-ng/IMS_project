<?php

    function isActive($thisPage) {

        return  $_GET['page'] == $thisPage? "menu-btn-active":"";

    }

?>

<div class="navbar">
    <div class="logo">
        <h3>
            <i class="fas fa-gem"></i>
            IMS
        </h3>
    </div>
    <div class="menu">
        <?php 
            echo "<a class='menu-btn profile-btn ";
            echo isActive('profile');
                    if ($_SESSION['role'] == 'admin')
                        echo " admin-profile-btn";
                    
                    echo "' href='";
                     if ($_SESSION['role'] == 'user')
                            echo "/project/public/dashboard-page.php?page=profile";
                        else 
                            echo "#";

                    echo "'>";
            ?>
            <i class="fas fa-user"></i>
            <span>
            <?php 
                if(isset($_SESSION['userID'])) 
                    echo $_SESSION['userID']; 
            ?>
            </span>
        </a>
        
        <?php 

            if($_SESSION['role'] == "user"){

                echo "
                    <a class='menu-btn ". isActive('products') ."' href='/project/public/dashboard-page.php?page=products'>
                        <i class='fas fa-tshirt'></i><span>Products</span>
                    </a>";

                $orderNumSQL = "

                    select count(*) as num from cart
                    where userID = '".$_SESSION['userID']."' and status = 'pending'

                ";

                $orderNumQ = mysqli_query($connect, $orderNumSQL);

                if($orderNum = mysqli_fetch_assoc($orderNumQ)){         

                    echo "
                    <a class='menu-btn ";

                    if($orderNum['num'] > 0){

                        echo "active-cart ";

                    }

                    echo isActive('shopping_cart');

                    echo "' href='/project/public/dashboard-page.php?page=shopping_cart' >
                        <i class='fas fa-shopping-cart'></i>
                        <span>Cart <span>";


                    echo "<span>" . $orderNum['num'] . "</span>";

                }else {
                    
                    echo "
                    <a class='menu-btn ". isActive("shopping_cart") ."' href='/project/public/dashboard-page.php?page=shopping_cart'>
                        <i class='fas fa-shopping-cart'></i><span>Cart <span>0</span></span>
                    </a>";

                }          

            }else if($_SESSION['role'] == 'admin'){

                echo "
                    <a class='menu-btn ". isActive("stock_checking") ."' href='/project/public/dashboard-page.php?page=stock_checking&table=inventory'
                    >
                        <i class='fas fa-box-open'></i><span>Stock</span>
                    </a>
                    <a class='menu-btn ". isActive("order") ."' href='/project/public/dashboard-page.php?page=order'>
                        <i class='fas fa-tasks'></i><span>Order</span>
                    </a>
                    <a class='menu-btn ". isActive("statistic") ."' href='/project/public/dashboard-page.php?page=statistic'>
                        <i class='fas fa-chart-line'></i><span>Statistic</span>
                    </a>
                ";

            }
                
        ?>
        
        <a class="menu-btn" href="/project/functions/login-functions.php?op=sign_out">
            <i class="fas fa-sign-out-alt"></i><span>Logout</span>
        </a>
    </div>
</div>

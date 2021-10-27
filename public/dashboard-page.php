<?php 

    include_once("./header.php");
    include_once("../functions/login-functions.php");
    session_start();

?>

<div class="container flex-column">

    <div class="navbar">
        <div class="logo">
            <h3>
                <i class="fas fa-gem"></i>
                IMS
            </h3>
        </div>
        <div class="menu">
            <a href="<?php if ($_SESSION['role'] == 'user')
                                echo "/project/public/dashboard-page.php?page=profile";
                            else 
                                echo "#";?>">
            <p>Hi, 
                <?php 
                    if(isset($_SESSION['userID'])) 
                        echo $_SESSION['userID']; 
                ?>! 
            </p></a>
            
            <?php 

                if($_SESSION['role'] == "user"){

                    echo "
                        <a class='menu-btn' href='/project/public/dashboard-page.php?page=products'>
                            <i class='fas fa-tshirt'></i></i> Tops
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

                            echo "active-cart";

                        }

                        echo"' href='/project/public/dashboard-page.php?page=shopping_cart'>
                            <i class='fas fa-shopping-cart'></i>Cart ";


                        echo "(" . $orderNum['num'] . ")";

                    }else {
                        
                        echo "
                        <a class='menu-btn' href='/project/public/dashboard-page.php?page=shopping_cart'>
                            <i class='fas fa-shopping-cart'></i>Cart (0)
                        </a>";

                    }          

                }else if($_SESSION['role'] == 'admin'){

                    echo "
                        <a class='menu-btn' href='/project/public/dashboard-page.php?page=stock_checking'>
                            <i class='fas fa-box-open'></i>Stock
                        </a>
                        <a class='menu-btn' href='/project/public/dashboard-page.php?page=order'>
                            <i class='fas fa-tasks'></i>Order
                        </a>
                        <a class='menu-btn' href='/project/public/dashboard-page.php?page=statistic'>
                            <i class='fas fa-chart-line'></i>Statistic
                        </a>
                    ";

                }
                   
            ?>
            
            <a class="menu-btn" href="/project/functions/login-functions.php?op=sign_out">
                <i class="fas fa-sign-out-alt"></i>Logout
            </a>
        </div>
    </div>

    <div class="main-section">
        <?php 
        
            if($_SESSION['role'] == "user"){

                switch ($_GET['page']){

                    case "products":
                        include_once("./products.php");
                        include_once("./product-detail.php");
                        break;

                    case "shopping_cart":
                        include_once("./shopping-cart.php");
                        break;
                    
                    case "profile":
                        include_once('./profile.php');
                        break;

                    default:
                        // 404 
                        break;

                }

            }else if($_SESSION['role'] == 'admin'){



            }else {

                // 404


            }

            
        ?>
    </div>

</div>

<?php 

    include_once("./footer.php");

?>
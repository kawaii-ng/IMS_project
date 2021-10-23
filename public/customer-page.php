<?php 

    include_once("../includes/header.html");
    include_once("../functions/login-functions.php");
    session_start();

?>

<div class="container flex-column">

    <div class="navbar">
        <div class="logo">
            <h5>
                <i class="fas fa-gem"></i>
                <span>I</span>nventory <span>M</span>anagement <span>S</span>ystem
            </h5>
        </div>
        <div class="menu">
            <a href="/project/public/customer-page.php?page=profile"><p>Hi, 
                <?php 
                    if(isset($_SESSION['userID'])) 
                        echo $_SESSION['userID']; 
                ?>! 
            </p></a>
            <a class="menu-btn" href="/project/public/customer-page.php?page=products">
                <i class="fas fa-tshirt"></i></i>
            </a>
            <?php 

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

                    echo"' href='/project/public/customer-page.php?page=shopping_cart'>
                        <i class='fas fa-shopping-cart'></i>";


                    echo "(" . $orderNum['num'] . ")";

                }else {
                    
                    echo "
                    <a class='menu-btn' href='/project/public/customer-page.php?page=shopping_cart'>
                        <i class='fas fa-shopping-cart'></i>(0)";

                }                    
                   
            ?>
            </a>
            <a class="menu-btn" href="/project/functions/login-functions.php?op=sign_out">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
    </div>

    <div class="main-section">
        <?php 
            if($_GET["page"] == 'products'){

                include_once("./products.php");
                include_once("./product-detail.php");

            }
            if($_GET["page"] == 'shopping_cart')
                include_once("./shopping-cart.php");

            if($_GET['page'] == 'profile'){

                include_once('./profile.php');

            }
        ?>
    </div>

</div>

<?php 

    include_once("../includes/footer.html");

?>
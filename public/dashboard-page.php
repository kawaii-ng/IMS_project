<?php 

    include_once("./header.php");
    include_once("../functions/login-functions.php");

?>

<div class="dashboard">

<?php

    include_once('./navbar.php');

?>
    
    <div class="dashboard-content">
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

                switch ($_GET['page']){

                    case "stock_checking":
                        include_once("./stock-checking.php");
                        break;
                    
                    case "order":
                        include_once('./order-page.php');
                        break;

                    case "statistic":
                        include_once('./statistic-page.php');
                        break;
                    
                    default:
                        //404
                        break;

                }

            }else {

                // 404


            }

            
        ?>
    </div>

</div>

<?php 

    include_once("./footer.php");

?>
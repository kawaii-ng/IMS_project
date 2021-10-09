<?php 

    include_once("../includes/header.html");
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
            <p>Hi, Evan Ng! </p>
            <a class="menu-btn" href="/project/public/customer-page.php?page=shopping_cart">
                <i class="fas fa-shopping-cart"></i>
                <?php echo "(0)";?>
            </a>
            <a class="menu-btn" href="/project/public/customer-page.php?page=products">
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
        ?>
    </div>

</div>

<?php 

    include_once("../includes/footer.html");

?>
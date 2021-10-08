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
            <button class="menu-btn">
                <i class="fas fa-shopping-cart"></i>
                Shopping Cart <?php echo "(0)";?>
            </button>
            <button class="menu-btn">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </button>
        </div>
    </div>

    <div class="fashion-section">
        <div id="top"></div>
        <i class="scroll-to-top fas fa-arrow-up"></i>

        <div class="product-grid">

            <div class="product-card">
                <img class="product-img" src="./images/t-shirt.jpeg" alt="">
                <div class="card-content">
                    <small class='product-id'>123123</small>
                    <h5 class="product-name">Utility oversized jacket </h5>
                    <h3 class='product-price'>HK$1,000.00</h3>
                </div>
            </div>
            <div class="product-card">
                <img class="product-img" src="./images/t-shirt.jpeg" alt="">
                <div class="card-content">
                    <small class='product-id'>123123</small>
                    <h5 class="product-name">Utility oversized jacket </h5>
                    <h3 class='product-price'>HK$1,000.00</h3>
                </div>
            </div>
            <div class="product-card">
                <img class="product-img" src="./images/t-shirt.jpeg" alt="">
                <div class="card-content">
                    <small class='product-id'>123123</small>
                    <h5 class="product-name">Utility oversized jacket </h5>
                    <h3 class='product-price'>HK$1,000.00</h3>
                </div>
            </div>
            <div class="product-card">
                <img class="product-img" src="./images/t-shirt.jpeg" alt="">
                <div class="card-content">
                    <small class='product-id'>123123</small>
                    <h5 class="product-name">Utility oversized jacket </h5>
                    <h3 class='product-price'>HK$1,000.00</h3>
                </div>
            </div>
            

        </div>

    </div>

</div>

<?php 

    include_once("../includes/footer.html");

?>
<div class='title-bar'>
    <?php

        if($_GET['page'] == 'shopping_cart'){

            echo"
            <h3>My Shopping Cart</h3>
            <div>
                <strong>Total: HK$" .  $_SESSION['totalPrice'] ."</strong>     
                <button class='btn buy-btn'>Buy all</button>
            </div>";
        
        }

    ?>
</div>


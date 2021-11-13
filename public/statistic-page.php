<?php

    include_once('../config/db-connection.php');

    $salesSQL = "
        select sum(product.price * cart.quantity) as totalSales from cart, product, stock
        where cart.status = 'purchase'
        and stock.stockID = cart.stockID
        and product.productID = stock.productID
        group by product.productID
        order by totalSales
        asc limit 10%;
    "; 

?>

<div>
</div>
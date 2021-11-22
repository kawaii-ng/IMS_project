<?php

    /*
    * to obtain the data from the database and generate the statistic based on these obtained data
    */

    include_once('../config/db-connection.php');


if($_POST['op'] == 'get_pie'){

    $pieData = array();
    
    // get ratio of cart status
    $refundSQL = "
    
        select * from cart
        where status = 'refunding'
    
    ";
    $refundQ = mysqli_query($connect, $refundSQL);
    $refundNum = mysqli_num_rows($refundQ);
    array_push($pieData, $refundNum);
    
    $invalidSQL = "
    
        select * from cart
        where status = 'invalid'
    
    ";
    $invalidQ = mysqli_query($connect, $invalidSQL);
    $invalidNum = mysqli_num_rows($invalidQ);
    array_push($pieData, $invalidNum);
    
    $purchaseSQL = "
    
        select * from cart
        where status = 'purchased'
    
    ";
    $purchaseQ = mysqli_query($connect, $purchaseSQL);
    $purchaseNum = mysqli_num_rows($purchaseQ);
    array_push($pieData, $purchaseNum);
    
    $pendingSQL = "
        
        select * from cart
        where status = 'pending'
    
    ";
    $pendingQ = mysqli_query($connect, $pendingSQL);
    $pendingNum = mysqli_num_rows($pendingQ);
    array_push($pieData, $pendingNum);
    
    echo json_encode($pieData);


}

if($_POST['op'] == 'get_line'){


    // get sales last 7 days
    $salesSQL = "
    
        select a.date, ifnull(b.totalsales,0) as sales from (
            select curdate() as date
            union all
            select date_sub(curdate(), interval 1 day) as date
            union all
            select date_sub(curdate(), interval 2 day) as date
            union all
            select date_sub(curdate(), interval 3 day) as date
            union all
            select date_sub(curdate(), interval 4 day) as date
            union all
            select date_sub(curdate(), interval 5 day) as date
            union all
            select date_sub(curdate(), interval 6 day) as date
        ) a left join (
            select sum(product.productPrice * cart.quantity) as totalsales, DATE(cart.time) as date 
            from cart, product, stock
            where cart.status = 'purchased'
            and stock.stockID = cart.stockID
            and product.productID = stock.productID
            group by date
            order by date DESC
        ) as b on a.date = b.date
        order by a.date ASC;

    ";

    $salesQ = mysqli_query($connect, $salesSQL);

    $saleArr = array();

    $counter = 0;
    while($sales = mysqli_fetch_assoc($salesQ)){

        $saleArr[$counter] = $sales;
        $counter++;

    }

    echo json_encode($saleArr);


}


if($_POST['op'] == 'get_bar'){


    // top N % query
    $topNSQL = "
        select product.productID from cart, product, stock
        where cart.status = 'purchased'
        and stock.stockID = cart.stockID
        and product.productID = stock.productID
        group by product.productID
    ";
    
    if($topNQ = mysqli_query($connect, $topNSQL)){
    
        $numRow = mysqli_num_rows($topNQ);
        $topN = intval($numRow * $_POST['top'] / 100);
        if($topN < $_POST['top']){
    
            $topN = 1;
    
        }
    
    }
    
    $salesSQL = "
        select product.productID, sum(cart.quantity) as salesAmount from cart, product, stock
        where cart.status = 'purchased'
        and stock.stockID = cart.stockID
        and product.productID = stock.productID
        group by product.productID
        order by salesAmount desc
        limit ".$topN."
    "; 
    
    $salesQ = mysqli_query($connect, $salesSQL);
    
    $topSalesArr = array();

    $counter = 0;
    
    while($sales = mysqli_fetch_assoc($salesQ)){
    
        $topSalesArr[$counter] = array("productID"=>$sales['productID'], "salesAmount"=>$sales['salesAmount']);
        $counter++;
    
    }

    echo json_encode($topSalesArr);


}



?>
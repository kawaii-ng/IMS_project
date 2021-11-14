<?php
    
    include_once('./title-bar.php');

?>

<div class='content'>

    <div class='stat-panel'>
        
        <div>
            <h3>Total Sales in Last 7 Days</h3>
            <canvas id="lineChart"></canvas>
            <h6>Date</h6>
        </div>
        
        <div id='pie-chart-container'>
            <h3>Percentage of the Cart Status</h3>
            <canvas id="pieChart"></canvas>
        </div>
    
        <div>
            <h3>Top 10% of Sales Amount</h3>
            <canvas id="barChart"></canvas>
            <h6>Product ID</h6>
        </div>
        
    </div>
    
</div>
$('document').ready(function(){

    $.ajax({

        url: '/project/functions/chart-data.php',
        method: 'POST',
        data: {op: 'get_pie'},
        success: function(data){
            

            var pieData = {

                datasets: [{
                    data: JSON.parse(data),
                    backgroundColor: [
                        '#007777',
                        '#134f4e',
                        '#122929',
                        '#000000'
                    ],
                }], 
                labels: [

                    'Refunding', "Invalid", "Purchased", "Pending"

                ]

            }
            
            //console.log(pieData)

            const config = {
                type: 'doughnut',
                data: pieData,
            };

            const pieChart = new Chart(
                document.getElementById('pieChart'),
                config
            );
            
        }
        
    })

    $.ajax({

        url: '/project/functions/chart-data.php',
        method: 'POST',
        data: {op: 'get_line'},
        success: function(data){

            var sales = [];
            var labels = [];

            var phpData = JSON.parse(data)

            for(var i = 0; i < phpData.length; i++){

                sales.push(phpData[i].sales)
                labels.push(phpData[i].date)

            }
            
            var lineData = {

                datasets: [{
                    label: 'Total Sales',
                    data: sales,
                    borderColor:'#007777',
                    fill: false,
                    tension: 0.1
                        
                }], 
                labels: labels

            }
            
            //console.log(lineData)

            const config = {
                type: 'line',
                data: lineData,
                options: {
                indexAxis: 'x',
                scales: {
                    y: {
                    beginAtZero: true
                    }
                }
                }
            };

            const lineChart = new Chart(
                document.getElementById('lineChart'),
                config
            );
            
        }
        

    })
    
    $.ajax({

        url: '/project/functions/chart-data.php',
        method: 'POST',
        data: {op: 'get_bar', top: 10},
        success: function(data){

            console.log(data)

            var sales = [];
            var labels = [];

            var phpData = JSON.parse(data)

            for(var i = 0; i < phpData.length; i++){

                sales.push(phpData[i].salesAmount)
                labels.push(phpData[i].productID)

            }
            
            var barData = {

                datasets: [{
                    label: ' Amount of Product Sales',
                    data: sales,
                    backgroundColor:'#007777',
                    borderWidth: 0
                }], 
                labels: labels

            }
            
            console.log(barData)

            const config = {
                type: 'bar',
                data: barData,
                options: {
                indexAxis: 'x',
                scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };

            const barChart = new Chart(
                document.getElementById('barChart'),
                config
            );
            
        }
        

    })

})
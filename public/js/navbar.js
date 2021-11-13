$('document').ready(function() {

    var currentPage = "";

    $.ajax({

        url: "/project/functions/login-functions.php",
        method: "POST",
        data: {op: 'get_role'},
        success: function(data){

            console.log(data)

            if(data == 'admin'){

                // initialize the page = stock-checking.php
                currentPage = "stock-checking";
                $('.dashboard-panel').load(currentPage+'.php');
                $.ajax({
            
                    url: "/project/public/title-bar.php",
                    method: "POST",
                    data: {page: currentPage},
                    success: function(data){
                        
                        console.log(data);
                        $('.title-bar').html(data)
                        $.ajax({
            
                            url: "/project/public/controller.php",
                            method: "POST",
                            data: {table: 'category'},
                            success: function(data){
                                
                                console.log(data);
                                $('.my-table').html(data)
                                stockManager();
                    
                            }                
                            
                        })
                        
            
                    }                
                    
                })

            }else {

                // initialize the page = stock-checking.php
                currentPage = "products";
                $('.dashboard-panel').load(currentPage+'.php');
                $.ajax({
            
                    url: "/project/public/title-bar.php",
                    method: "POST",
                    data: {page: currentPage},
                    success: function(data){
                        
                        console.log(data);
                        $('.title-bar').html(data)
            
                    }                
                    
                })

            }
            
        }
            
    })

    $('.menu-btn').click(function() {

        $('.menu-btn').removeClass('menu-btn-active')
        $(this).addClass('menu-btn-active')
        var target = $(this).data('target');
        currentPage = target;
        $('.dashboard-panel').load(target+'.php');

        $.ajax({
            
            url: "/project/public/title-bar.php",
            method: "POST",
            data: {page: currentPage},
            success: function(data){
                
                console.log(data);
                $('.title-bar').html(data)                
    
            }                
            
        })
        if(currentPage == 'stock-checking'){

            $.ajax({
            
                url: "/project/public/title-bar.php",
                method: "POST",
                data: {page: currentPage},
                success: function(data){
                    
                    console.log(data);
                    $('.title-bar').html(data)
                    $.ajax({
        
                        url: "/project/public/controller.php",
                        method: "POST",
                        data: {table: 'category'},
                        success: function(data){
                            
                            console.log(data);
                            $('.my-table').html(data)
                            stockManager();
                
                        }                
                        
                    })
                    
        
                }                
                
            })

        }
        console.log('clicking menu btn')

    })

    // const switchPage = (page) => {

    //     $.ajax({

    //         url: 'navbar.php',
    //         cache: false,
    //         complete: function () {switchPage(page);}

    //     })

    // }

})
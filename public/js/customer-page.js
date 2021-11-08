$('document').ready(function () {
    
    var currentID = '';

    var idList = $('.product-card').map(function(index) {

        return this.id

    })
    
    const setButton = () => {

        var qty = $('.count').val();
        var color = $('.colorValue').val();
        var size = $('.sizeValue').val();

        console.log('id: ', currentID)
        console.log('color: ', color)
        console.log('size: ', size)
        console.log('qty: ', qty)

        $.ajax({

            url: "/project/functions/checking-stock.php",
            method: "POST",
            data: {op: "check_stock",id: currentID, color: color, size: size, qty: qty},
            success: function(data){
    
                console.log("data: " + data)
                $('#product-btn-' + currentID).prop('disabled', data === 'false')
    
            }   
        
        })


    }


    for(let i = 0; i < idList.length; i++){

        var idName = idList[i].toString()
        let regex = /\d/g
        let index = idName.indexOf(idName.match(regex)[0])
        let id = idName.substring(index)

        $('#product-' + id).click(function() {
            
            $('#product-modal-' + id).toggleClass('detail-modal-active');
            $('#product-modal-' + id).animate({opacity: '1', top: '0px'}, 100);
            // $('.detail-modal').css('display', "block");
            var color = $('#product-modal-' + id + ' .color.color-size-active').text()
            $('.colorValue').val(color.trim())
            var size = $('#product-modal-' + id + ' .size.color-size-active').text()
            $('.sizeValue').val(size.trim());
            currentID = id;
            setButton();

        })
    
        $('#product-close-' + id).click(function() {

            $('.count').val(1);
    
            $('#product-modal-' + id).animate({opacity: '0', top: '50px'}, 100, ()=>{
    
                setTimeout(()=>{
                    $('#product-modal-' + id).toggleClass('detail-modal-active');   
                }, 300)
    
            });     
        })

        $('#product-modal-' + id + ' .color').click((e)=>{

            if(!($(e.target).attr("class").includes("color-size-active"))){
                
                $('#product-modal-' + id + ' .color').removeClass('color-size-active')
                $(e.target).toggleClass('color-size-active')
                var color = $(e.target).text()
                $('.colorValue').val(color.trim())

                // var qty = $('.count').val();
                // var color = $('.colorValue').val();
                // var size = $('.sizeValue').val();

                // console.log('id: ', currentID)
                // console.log('color: ', color)
                // console.log('size: ', size)
                // console.log('qty: ', qty)

                // $.ajax({
        
                //     url: "/project/functions/checking-stock.php",
                //     method: "POST",
                //     data: {op: "check_stock",id: currentID, color: color, size: size, qty: qty},
                //     success: function(data){
            
                //         console.log("data: " + data)
                //         $('#product-btn-' + currentID).attr("disabled", data)
            
                //     }                
            
                // })

                setButton();
            
            }
    
        })

        $('#product-modal-' + id + ' .size').click((e)=>{

            if(!($(e.target).attr("class").includes("color-size-active"))){
                
                $('#product-modal-' + id + ' .size').removeClass('color-size-active')
                $(e.target).toggleClass('color-size-active');
                var size = $(e.target).text()
                $('.sizeValue').val(size.trim());

                setButton();

                // var qty = $('.count').val();
                // var color = $('.colorValue').val();
                // var size = $('.sizeValue').val();

                // console.log('id: ', currentID)
                // console.log('color: ', color)
                // console.log('size: ', size)
                // console.log('qty: ', qty)
    
                // $.ajax({
        
                //     url: "/project/functions/checking-stock.php",
                //     method: "POST",
                //     data: {op: "check_stock",id: currentID, color: color, size: size, qty: qty},
                //     success: function(data){
            
                //         console.log("data: " + data)
                //         $('#product-btn-' + currentID).attr("disabled", data)
            
                //     }                
            
                // })
    
            }
    
        })

        $('#product-btn-' + id).click(function() {

            $('#product-modal-' + id).animate({opacity: '0', top: '50px'}, 100, ()=>{
                
                setTimeout(()=>{
                    $('#product-modal-' + id).toggleClass('detail-modal-active');   
                }, 300)
                
            });   
            
            $('#product-btn-' + id).attr('type', 'submit')
            purchaseForm.submit()

            $('.count').val(1);
            $('#product-btn-' + id).attr('type', 'button')
    
        })

        // $('#product-modal-'+id).change(function () {
    
        //     let ID = id;
        //     currentID = ID;
        //     var color = $('.colorValue').val();
        //     var size = $('.sizeValue').val();
        //     var qty = $('.count').val();
        //     console.log('id: ', ID)
        //     console.log('color: ', color)
        //     console.log('size: ', size)
        //     console.log('qty: ', qty)
        
        //     $.ajax({
        
        //         url: "/project/functions/checking-stock.php",
        //         method: "POST",
        //         data: {op: "check_stock",id: ID, color: color, size: size, qty: qty},
        //         success: function(data){
        
        //             console.log("data: " + data)
        
        //         }                
        
        //     })
        
        // })
        

    }

    $('.count-add-btn').click(()=>{
    
        console.log("count: ", parseInt($('.count').val()))
        $('.count').val(parseInt($('.count').val()) + 1);

        setButton();
        // var qty = $('.count').val();
        // var color = $('.colorValue').val();
        // var size = $('.sizeValue').val();
        // console.log('id: ', currentID)
        // console.log('color: ', color)
        // console.log('size: ', size)
        // console.log('qty: ', qty)
        // $.ajax({
        
        //     url: "/project/functions/checking-stock.php",
        //     method: "POST",
        //     data: {op: "check_stock",id: currentID, color: color, size: size, qty: qty},
        //     success: function(data){
    
        //         console.log("data: " + data)
        //         $('#product-btn-' + currentID).attr("disabled", data)
    
        //     }                
    
        // })

    })
    
    $('.count-minus-btn').click(()=>{

        if(parseInt($('.count').val()) > 1)
            $('.count').val(parseInt($('.count').val()) - 1);

        // var qty = $('.count').val();
        // var color = $('.colorValue').val();
        // var size = $('.sizeValue').val();

        // console.log('id: ', currentID)
        // console.log('color: ', color)
        // console.log('size: ', size)
        // console.log('qty: ', qty)
        // $.ajax({
        
        //     url: "/project/functions/checking-stock.php",
        //     method: "POST",
        //     data: {op: "check_stock",id: currentID, color: color, size: size, qty: qty},
        //     success: function(data){
    
        //         console.log("data: " + data)
        //         $('#product-btn-' + currentID).attr("disabled", data)
    
        //     }                
    
        // })

        setButton();

    })


})
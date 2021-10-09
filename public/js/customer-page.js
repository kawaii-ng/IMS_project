$('document').ready(()=>{
    
    $('#product-123').click(()=>{

        $('#product-123-modal').toggleClass('detail-modal-active');
        $('#product-123-modal').animate({opacity: '1', top: '0px'}, 100);
        // $('.detail-modal').css('display', "block");

    })

    $('#product-123-close').click(()=>{

        $('#count').val() = 0;

        $('#product-123-modal').animate({opacity: '0', top: '50px'}, 100, ()=>{

            setTimeout(()=>{
                $('#product-123-modal').toggleClass('detail-modal-active');   
            }, 300)

        });     
    })

    $('#count-add-btn').click(()=>{

        $('#count').val(parseInt($('#count').val()) + 1);

    })
    
    $('#count-minus-btn').click(()=>{

        if(parseInt($('#count').val()) > 1)
            $('#count').val(parseInt($('#count').val()) - 1);

    })

})
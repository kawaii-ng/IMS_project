$('document').ready(function() {

    var orderList = $('.order-card').map(function(index) {

        return this.id

    })

    for (let i = 0; i < orderList.length; i++ ){

        var idName = orderList[i].toString()
        let regex = /\d/g
        let index = idName.indexOf(idName.match(regex)[0])
        let id = idName.substring(index)

        $('#remove-' + id).click(function() {

            $('.remove-modal-container').css('display', 'flex')

        })

        $('#purchase-' + id).click(function() {

            $('.purchase-modal-container').css('display', 'flex')
    
    
        })

        $('#confirm-btn-'+id).click(function() {

            $('.remove-modal-container').css('display', 'none')
            $('#remove-' + id).attr('type', 'submit')
            $('#purchase-' + id).attr('type', 'submit')
            $('#cart-ID').val(id)
            cartForm.submit()
            $('#remove-' + id).attr('type', 'button')      
            $('#purchase-' + id).attr('type', 'button')      

        })

    }

    // $('.remove-model-container').clicked(function() {

    //     $('.remove-modal-container').css('display', 'none')

    // })

    $('#cancel-btn').click(function() {

        $('.remove-modal-container').css('display', 'none')
        $('.purchase-modal-container').css('display', 'none')

    })

    $('#buy-all-btn').click(function () {

        $('#payment-step-1').css('display', 'flex')
        $('#payment-step-2').css('display', 'none')
        $('.purchase-modal-container').css('display', 'flex')

    })

    $('#confirm-total-btn').click(function() {
        
        $('#payment-step-1').css('display', 'none')
        $('#payment-step-2').css('display', 'flex')

    })

    $('#purchase-all-btn').click(function() {
        
    
        $('.purchase-modal-container').css('display', 'none')
        $.ajax({

            url: '/project/functions/customer-functions.php',
            method: "POST",
            data: {op: "buy_all"},
            success: function(data){

                console.log(data)
                location.reload()

            }

        })


    })
    

})
const cartManager = () => {

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

        $('#confirm-btn-'+id).click(function() {

            $('.remove-modal-container').css('display', 'none')
            $('#remove-' + id).attr('type', 'submit')
            $('#cart-ID').val(id)
            cartForm.submit()
            $('#remove-' + id).attr('type', 'button')      

        })

    }

    // $('.remove-model-container').clicked(function() {

    //     $('.remove-modal-container').css('display', 'none')

    // })

    $('#cancel-btn').click(function() {

        $('.remove-modal-container').css('display', 'none')

    })


})

}
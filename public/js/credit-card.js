$(document).ready(function() {

    const updataBtnState = () => {

        if($('#card-holder').val().length == 0
            || !($('#card-holder').val().match(/^[A-Z]+[a-z]*\s*([A-Z]+[a-z]*\s*)*$/))
           || $('#card-num').val().length < 16
           || $('#expiry-month').val().length < 2
           || $('#expiry-year').val().length < 2
           || $('#cvc').val().length < 3 
           || $('#expiry-month').val() > 12)
           $('#purchase-all-btn').prop('disabled', true)
        else
           $('#purchase-all-btn').prop('disabled', false)

    }

    updataBtnState()

    $('#card-holder').change(function(){

        $('#card-card-name').html($('#card-holder').val())
        updataBtnState()

    })

    $('#card-num').change(function() {

        var cardNum = $('#card-num').val()

        if(cardNum < 0){
            
            $('#card-num').val(Math.abs(cardNum))
            cardNum = $('#card-num').val()

        }

        if(cardNum.length > 16){

            $('#card-num').val(cardNum.substring(0, 16))
            cardNum = $('#card-num').val()

        }

        var temp = "";
        for(var i = 0; i < cardNum.length; i++){

            temp += cardNum[i];
            if((i+1) % 4 == 0 && i != 0)
                temp += " "

        }

        $('.card-card-number').html(temp)
        updataBtnState()

    })

    $('#expiry-month').change(function(){

        var m = $('#expiry-month').val()

        if(m < 0){
            
            $('#expiry-month').val(Math.abs(m))
            m = $('#expiry-month').val()

        }

        console.log(m)

        if(m.length > 2){

            $('#expiry-month').val(m.substring(0, 2))
            m = $('#expiry-month').val()
        }

        $('#card-card-month').html(m)
        updataBtnState()

    })
    
    $('#expiry-year').change(function(){

        var y = $('#expiry-year').val()

        if(y < 0){
            
            $('#expiry-year').val(Math.abs(y))
            y = $('#expiry-year').val()

        }

        if(y.length > 2){

            $('#expiry-year').val(y.substring(0, 2))
            y = $('#expiry-year').val()

        }

        $('#card-card-year').html(y)
        updataBtnState()

    })

    $('#cvc').change(function(){

        var cvc = $('#cvc').val()

        if(cvc < 0){

            $('#cvc').val(Math.abs(cvc))
            cvc = $('#cvc').val()

        }
           
        if(cvc.length > 3){

            $('#cvc').val(cvc.substring(0, 3))
            cvc = $('#cvc').val()

        }

        $('#card-card-cvc').html(cvc)
        updataBtnState()

    })


})
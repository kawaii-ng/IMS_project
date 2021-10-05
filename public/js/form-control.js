$('document').ready(()=>{

    var step = 1;

    $('#create-ac-btn').click(()=>{
        
        $('#login-form').css('display', 'none');
        $('#register-form').css('display', 'block');
        $('#register-form-1').css('display', 'block');
        $('#register-form-2').css('display', 'none');
        $('#form-action-btn').hide();
        $('#prev-btn').hide();
  
    })
    
    $('#login-ac-btn').click(()=>{
        
        $('#login-form').css('display', 'block');
        $('#register-form').css('display', 'none');
        $('#form-action-btn').show();

        step = 1;
  
    })

    $('#next-btn').click(()=>{

        if(step !== 3)
            step++;

        if(step == 1){

            $('#register-form-1').css('display', 'block');
            $('#register-form-2').css('display', 'none');
            $('#prev-btn').hide();
            $('#next-btn').show();

        }

        if(step == 2){

            $('#register-form-1').css('display', 'none');
            $('#register-form-2').css('display', 'block');
            $('#prev-btn').show();
            $('#next-btn').show();

        }

    })
    
    $('#prev-btn').click(()=>{

        if(step !== 1)
            step--;

        if(step == 1){

            $('#register-form-1').css('display', 'block');
            $('#register-form-2').css('display', 'none');
            $('#prev-btn').hide();
            $('#next-btn').show();

        }

        if(step == 2){

            $('#register-form-1').css('display', 'none');
            $('#register-form-2').css('display', 'block');
            $('#prev-btn').show();
            $('#next-btn').show();

        }

    })


})
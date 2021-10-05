$('document').ready(()=>{

    var step = 0;

    const errorMessage = (myElement, type) => {

        if(type == "empty")
            return "<p class='error'><i class='fas fa-exclamation-circle'></i> Please fill in " + myElement + ".</p>"

        if(type == "notMatch")
            return "<p class='error'><i class='fas fa-exclamation-circle'></i> " + myElement + " is not matched.</p>"
        
        if(type == "other")
            return "<p class='error'><i class='fas fa-exclamation-circle'></i> " + myElement 

    }

    const checkValid = () => {
        
        var isValid = true;

        // reset 
        $('input').css('border-color', '#007777');
        $('.error').remove();

        if(step == 0){

            if($('#login-id').val().length == 0){

                $('#login-id').css('border-color', 'red');
                $('#login-id').after(errorMessage("user ID", "empty"))

                isValid = false;

            }

            if($('#login-pw').val().length == 0){

                $('#login-pw').css('border-color', 'red');
                $('#login-pw').after(errorMessage("password", "empty"))

                isValid = false;

            }

            if(isValid)
                return true

        }

        if(step == 1){

            if($('#first-name').val().length == 0){

                $('#first-name').css('border-color', 'red');
                $('#first-name').after(errorMessage("first name", "empty"))

                isValid = false;

            }
            
            if($('#last-name').val().length == 0){

                $('#last-name').css('border-color', 'red');
                $('#last-name').after(errorMessage("last name", "empty"))

                isValid = false;

            }

            if(isValid)
                return true

        }

        if(step == 2){

            if($('#user-id').val().length == 0){

                $('#user-id').css('border-color', 'red');
                $('#user-id').after(errorMessage("user ID", "empty"))

                isValid = false 

            }   

            if($('#user-pw').val().length == 0){

                $('#user-pw').css('border-color', 'red');
                $('#user-pw').after(errorMessage("password", "empty"))

                isValid = false 

            }

            if($('#user-pw').val().length > 0 && $('#user-pw').val().length < 8){

                $('#user-pw').css('border-color', 'red');
                $('#user-pw').after(errorMessage("Password", "other") + " is not less than 8. </p>")

                isValid = false 

            }

            if($('#confirm-pw').val().length == 0){

                $('#confirm-pw').css('border-color', 'red');
                $('#confirm-pw').after(errorMessage("Confirmed password", "empty"))

                isValid = false 

            }

            if($('#confirm-pw').val().length != 0 && $('#confirm-pw').val() !== $('#user-pw').val()){

                $('#confirm-pw').css('border-color', 'red');
                $('#confirm-pw').after(errorMessage("Confirmed password", "notMatch"))

                isValid = false 

            }
            
            if($('#security-ans').val().length == 0){

                $('#security-ans').css('border-color', 'red');
                $('#security-ans').after(errorMessage("answer", "empty"))

                isValid = false 

            }
            
            if(isValid)
                return true

        }

        return false


    }

    $('#create-ac-btn').click(()=>{
        
        $('#login-form').css('display', 'none');
        $('#register-form').css('display', 'block');
        $('#register-form-1').css('display', 'block');
        $('#register-form-2').css('display', 'none');
        $('#register-form-3').css('display', 'none');
        $('#form-action-btn').hide();
        $('#prev-btn').hide();

        step = 1;
  
    })
    
    $('#login-ac-btn').click(()=>{
        
        $('#login-form').css('display', 'block');
        $('#register-form').css('display', 'none');
        $('#form-action-btn').show();
        $('#form-action-btn').val("Login");

        step = 0;
  
    })

    $('#next-btn').click(()=>{

        //if(step !== 3 && checkValid())
            step++;

        if(step == 1){

            $('#register-form-1').css('display', 'block');
            $('#register-form-2').css('display', 'none');
            $('#register-form-3').css('display', 'none');
            $('#prev-btn').hide();
            $('#next-btn').show();

        }

        if(step == 2){

            $('#register-form-1').css('display', 'none');
            $('#register-form-2').css('display', 'block');
            $('#register-form-3').css('display', 'none');
            $('#prev-btn').show();
            $('#next-btn').show();

        }
        
        if(step == 3){

            $('#register-form-1').css('display', 'none');
            $('#register-form-2').css('display', 'none');
            $('#register-form-3').css('display', 'block');
            $('#prev-btn').show();
            $('#next-btn').hide();
            $('#form-action-btn').show();
            $('#form-action-btn').val("Register");

        }

    })
    
    $('#prev-btn').click(()=>{

        if(step !== 1)
            step--;

        if(step == 1){

            $('#register-form-1').css('display', 'block');
            $('#register-form-2').css('display', 'none');
            $('#register-form-3').css('display', 'none');
            $('#prev-btn').hide();
            $('#next-btn').show();

        }

        if(step == 2){

            $('#register-form-1').css('display', 'none');
            $('#register-form-2').css('display', 'block');
            $('#register-form-3').css('display', 'none');
            $('#prev-btn').show();
            $('#next-btn').show();

        }

        if(step == 3){

            $('#register-form-1').css('display', 'none');
            $('#register-form-2').css('display', 'none');
            $('#register-form-3').css('display', 'block');
            $('#prev-btn').show();
            $('#next-btn').hide();
            $('#form-action-btn').show();
            $('#form-action-btn').val("Register");


        }

    })


})
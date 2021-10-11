$('document').ready(()=>{

    var step = 1;
    var showAnimation = {

        'opacity': '1',
        'marginLeft': '0px'

    }

    var hideAnimation = {

        'opacity': '0',
        'marginLeft': '-50px'

    }

    const errorMessage = (elementName, type) => {

        if(type == "empty")
            return "<p class='error'><i class='fas fa-exclamation-circle'></i> Please fill in " + elementName + ".</p>"

        if(type == "notMatch")
            return "<p class='error'><i class='fas fa-exclamation-circle'></i> " + elementName + " is not matched.</p>"
            
        if(type == 'notValid')
            return "<p class='error'><i class='fas fa-exclamation-circle'></i> " + elementName + " is not valid.</p>"

        if(type == "custom")
            return "<p class='error'><i class='fas fa-exclamation-circle'></i> " + elementName 

    }

    const errorDisplay = (elementID, elementName, type) => {

        $(elementID).css('border-color', 'red');
        $(elementID).after(errorMessage(elementName, type))

    }

    const checkValid = () => {
        
        var isValid = true;

        // reset 
        $('input').css('border-color', '#007777');
        $('.error').remove();

        if(step == 0){

            if($('#login-id').val().length == 0){

                errorDisplay('#login-id', 'User ID', 'empty')
                isValid = false;

            }

            if($('#login-pw').val().length == 0){

                errorDisplay('#login-pw', 'password', 'empty')
                isValid = false;

            }

            if(isValid)
                return true

        }

        if(step == 1){

            if($('#nick-name').val().length == 0){

                errorDisplay('#nick-name', 'nick name', 'empty')
                isValid = false;

            }

            if($('#birthday').val().length !== 0 
                && (new Date($('#birthday').val()).getFullYear() < new Date().getFullYear() - 100
                || new Date($('#birthday').val()).getFullYear() > new Date().getFullYear() - 10)){

                    errorDisplay('#birthday', 'Birthday is invalid.', 'custom')
                    isValid = false;

            }

            if(isValid)
                return true

        }

        if(step == 2){

            if($('#user-id').val().length == 0){

                errorDisplay('#user-id', 'user ID', 'empty');
                isValid = false 

            }   

            if($('#user-pw').val().length == 0){

                errorDisplay('#user-pw', 'password', 'empty')
                isValid = false 

            }

            if($('#user-pw').val().length > 0 && $('#user-pw').val().length < 8){

                errorDisplay('#user-pw', 'Password is not less than 8.', 'custom')
                isValid = false 

            }

            if($('#confirm-pw').val().length == 0){

                errorDisplay("#confirm-pw", 'Confirmed password', 'empty')
                isValid = false 

            }

            if($('#confirm-pw').val().length != 0 && $('#confirm-pw').val() !== $('#user-pw').val()){

                errorDisplay("#confirm-pw", 'Confirmed password', 'notMatch')
                isValid = false 

            }
            
            if($('#security-ans').val().length == 0){

                errorDisplay('#security-ans', 'answer', 'empty')
                isValid = false 

            }
            
            if(isValid)
                return true

        }

        return false


    }

    $('#form-action-btn').click(()=>{

        if((step == 0 && checkValid()) || step !== 0){

            $('#form-action-btn').attr('type', 'submit');
            myForm.submit();

        }else {

            $('#form-action-btn').attr('type', 'button');

        }
        

    })

    $('#create-ac-btn').click(()=>{
    
        $('#form-action-btn').animate(hideAnimation, 100, () => {

            setTimeout(()=>{$('#form-action-btn').hide()}, 500)

        })
        
        $('#login-form').animate(hideAnimation, 100, () => { 
            setTimeout(()=>{
                $('#login-form').css('display', 'none')
                $('#register-form').css('display', 'block')
                $('#register-form').animate(showAnimation, 100);
                $('#register-form-1').css('display', 'block');
                $('#register-form-1').animate(showAnimation, 100);
                $('#register-form-2').css('display', 'none');
                $('#register-form-3').css('display', 'none');
                $('#prev-btn').hide();
            }, 500)
        });

        step = 1;
  
    })
    
    $('#login-ac-btn').click(()=>{
        
        $('#register-form').animate(hideAnimation, 100, () => {

            setTimeout(()=>{

                $('#register-form').css('display', 'none');
                $('#login-form').css('display', 'block');
                $('#login-form').animate(showAnimation, 100);

            }, 500)

        })

        $('#form-action-btn').val('Login')
        $('#form-action-btn').show(500)
        $('#form-action-btn').animate(showAnimation, 100)
        
        step = 0;
  
    })

    $('#next-btn').click(()=>{

        //if(step !== 3 && checkValid())
            step++;

        if(step == 2){

            $('#register-form-1').animate(hideAnimation, 100, () => {

                setTimeout(()=>{
    
                    $('#register-form-1').css('display', 'none');
                    $('#register-form-2').css('display', 'block');
                    $('#register-form-2').animate(showAnimation, 100);
                    $('#register-form-3').css('display', 'none');
                    $('#prev-btn').show(100);
                    $('#next-btn').show(100);
    
                }, 500)
    
            })

        }
        
        if(step == 3){

            $('#register-form-2').animate(hideAnimation, 100, () => {

                setTimeout(()=>{
    
                    $('#register-form-1').css('display', 'none');
                    $('#register-form-2').css('display', 'none');
                    $('#register-form-3').css('display', 'block');
                    $('#register-form-3').animate(showAnimation, 100);
                    $('#prev-btn').show(100);
                    $('#next-btn').hide(100);
                    
                }, 500)
    
            })

            $('#form-action-btn').val('Register')
            $('#form-action-btn').show(500)
            $('#form-action-btn').animate(showAnimation, 100)

        }

    })
    
    $('#prev-btn').click(()=>{

        if(step > 1)
            step--;

        if(step == 1){

            $('#register-form-2').animate(hideAnimation, 100, () => {

                setTimeout(()=>{
    
                    $('#register-form-1').css('display', 'block');
                    $('#register-form-1').animate(showAnimation, 100);
                    $('#register-form-2').css('display', 'none');
                    $('#register-form-3').css('display', 'none');
                    $('#prev-btn').hide(100);
                    $('#next-btn').show(100);
                    
                }, 500)
    
            })

        }

        if(step == 2){

            $('#form-action-btn').animate(hideAnimation, 100, () => {

                setTimeout(()=>{$('#form-action-btn').hide()}, 500)
    
            })

            $('#register-form-3').animate(hideAnimation, 100, () => {

                setTimeout(()=>{
    
                    $('#register-form-1').css('display', 'none');
                    $('#register-form-2').css('display', 'block');
                    $('#register-form-2').animate(showAnimation, 100);
                    $('#register-form-3').css('display', 'none');
                    $('#prev-btn').show(100);
                    $('#next-btn').show(100);
                    
                }, 500)
    
            })


        }

    })

    $('#profile-btn').click((e)=>{

        $('#profile-path').change((e)=>{

            $('.error').remove();
            var file = e.target.files[0];
            var path = URL.createObjectURL(file);
            var defaultPath = "../public/images/icon-add-128.png"
            var re = /.png|.jpg|.jpeg/i;
            if(file.name.search(re) !== -1){
                
                $('#reg-profile').attr('src', path);

            }else {

                e.value = '';
                $('#reg-profile').attr('src', 'images/icon-add-128.png');
                errorDisplay('#profile-path', 'Image', 'notValid');

            }

        })

    })


})
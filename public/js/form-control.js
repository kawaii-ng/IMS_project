$('document').ready(function() {

    var step = 1;
    var progress = 33.33;
    var currentPage = "Login";
    var isOK = true;
    var isUserExist = false;

    var showAnimation = {

        'opacity': '1',
        'marginLeft': '0px'

    }

    var hideAnimation = {

        'opacity': '0',
        'marginLeft': '-50px'

    }

    const setIsOK = (isok) => {

        console.log('running')
        isOK = isok
        console.log('isOK: ', isOK)

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

            if($('#nick-name').val().length != 0 && !($('#nick-name').val().match(/^[A-Z]+[a-z]*\s*([A-Z]+[a-z]*\s*)*$/))){

                errorDisplay('#nick-name', 'Nick name is invalid', 'custom')
                isValid = false;

            }

            if($('#birthday').val().length !== 0 
                && (new Date($('#birthday').val()).getFullYear() < new Date().getFullYear() - 100
                || new Date($('#birthday').val()).getFullYear() > new Date().getFullYear() - 10)){

                    errorDisplay('#birthday', 'Birthday is invalid.', 'custom')
                    isValid = false;
                    
                }
                
            if($('#email').val().length !== 0){
                    
                let email = $('#email').val();
                let regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*))@([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}$/
                if(!email.match(regex)){
                    
                    errorDisplay('#email', 'Email is invalid.', 'custom')
                    isValid = false

                }

                console.log("match: ", email.match(regex))
            }


            if(isValid)
                return true

        }

        if(step == 2){

            if($('#user-id').val().length == 0){

                errorDisplay('#user-id', 'user ID', 'empty');
                isValid = false 

            }   

            if(isUserExist)
                errorDisplay('#user-id', 'user ID exists.', 'custom');

            if($('#user-pw').val().length == 0){

                errorDisplay('#user-pw', 'password', 'empty')
                isValid = false 

            }

            if($('#user-pw').val().length > 0 && $('#user-pw').val().length < 8){

                errorDisplay('#user-pw', 'Password is less than 8.', 'custom')
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
            
            if(isValid && !isUserExist)
                return true

        }

        return false


    }

    $('#form-action-btn').click(function() {

        var canReset = true;
        
        $('input').css('border-color', '#007777');
        $('.error').remove();

        if(currentPage == "Reset"){

            if(step == 3){


                if($('#reset-pw').val() != $('#confirm-reset-pw').val() && $('#reset-pw').val().length >= 8){

                    errorDisplay('#confirm-reset-pw', 'Password', 'notMatch')
                    canReset = false;

                }

                if($('#reset-pw').val().length < 8){

                    errorDisplay('#reset-pw', 'Password should not less than 8.', 'custom')
                    canReset = false;

                }

            }

        }

        if(((step == 0 && checkValid()) || step !== 0) && (currentPage == 'Login' || currentPage == "Register") || (currentPage == "Reset") && canReset){

            $('#form-action-btn').attr('type', 'submit');
            myForm.submit();

        }else {

            $('#form-action-btn').attr('type', 'button');

        }
    
    })

    $('#forgot-pw-btn').click(function() {

        currentPage = "Reset";

        $('input').css('border-color', '#007777');
        $('.error').remove();

        $('#form-action-btn').animate(hideAnimation, 100, () => {

            setTimeout(()=>{$('#form-action-btn').hide()}, 500)

        })
        
        $('#login-form').animate(hideAnimation, 100, () => { 
            setTimeout(()=>{
                $('#login-form').css('display', 'none')
                $('#reset-form').css('display', 'block')
                $('#reset-form').animate(showAnimation, 100)
                $('#reset-form-1').css('display', 'block');
                $('#reset-form-1').animate(showAnimation, 100);
                $('#reset-form-2').css('display', 'none');
                $('#reset-form-3').css('display', 'none');
                $('.prev-btn').hide();
            }, 500)
        });

        step = 1;

    })

    $('#create-ac-btn').click(function() {

        currentPage = "Register";
    
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
                $('.prev-btn').hide();
            }, 500)
        });

        step = 1;
  
    })
    
    $('.login-ac-btn').click(function() {
        
        if(currentPage == 'Register'){

            $('#register-form').animate(hideAnimation, 100, () => {
    
                setTimeout(()=>{
    
                    $('#register-form').css('display', 'none');
                    $('#login-form').css('display', 'block');
                    $('#login-form').animate(showAnimation, 100);
    
                }, 500)
    
            })

        }

        if(currentPage == "Reset"){

            $('#reset-form').animate(hideAnimation, 100, () => {
    
                setTimeout(()=>{
    
                    $('#reset-form').css('display', 'none');
                    $('#login-form').css('display', 'block');
                    $('#login-form').animate(showAnimation, 100);
    
                }, 500)
    
            })

        }


        $('#form-action-btn').val('Login')
        $('#form-action-btn').show(500)
        $('#form-action-btn').animate(showAnimation, 100)
        
        step = 0;
  
    })

    $('#user-id').change(function() {

        $.ajax({

            url: '/project/functions/check-user-id.php',
            method: 'POST',
            data: {op: "check_id_exist", id: $('#user-id').val()},
            success: function(data){

                console.log('data: ', data)
                if(data == 'true'){

                    errorDisplay('#user-id', 'user ID exists.', 'custom');
                    isUserExist = true;
                    console.log('exist? ', isUserExist)
                    
                }else{
                    isUserExist = false;
                    $('#user-id').css('border-color', '#007777');
                    $('#user-id').nextAll('.error:first').remove();
                    console.log('exist? ', isUserExist)
                }

            }

        })

    })

    $('.next-btn').click(function() {

        if(currentPage == 'Register'){

            if(step !== 3 && checkValid()){

                step++;
                progress += 33.33
                $('.progress').css('width', progress + "%")
    
            }
            if(step == 2){
    
                $('#register-form-1').animate(hideAnimation, 100, () => {
    
                    setTimeout(()=>{
        
                        $('#register-form-1').css('display', 'none');
                        $('#register-form-2').css('display', 'block');
                        $('#register-form-2').animate(showAnimation, 100);
                        $('#register-form-3').css('display', 'none');
                        $('.prev-btn').show(100);
                        $('.next-btn').show(100);
        
                    }, 500)
        
                })
    
    
            }
            
            if(step == 3){
    
                if(currentPage == 'Register'){
    
    
                    $('#register-form-2').animate(hideAnimation, 100, () => {
        
                        setTimeout(()=>{
            
                            $('#register-form-1').css('display', 'none');
                            $('#register-form-2').css('display', 'none');
                            $('#register-form-3').css('display', 'block');
                            $('#register-form-3').animate(showAnimation, 100);
                            $('.prev-btn').show(100);
                            $('.next-btn').hide(100);
                            
                        }, 500)
            
                    })
        
                    $('#form-action-btn').val('Register')
                    $('#form-action-btn').show(500)
                    $('#form-action-btn').animate(showAnimation, 100)
    
                }
    
            }

        }    

        if(currentPage == 'Reset'){

            if(step == 1){

                $.ajax({

                    url: "/project/functions/check-user-id.php",
                    method: "POST",
                    data: {op: "check_user_id",id: $('#reset-id').val()},
                    success: function(data){
            
                        console.log("data: " + data)
                        isTrue = (data !== 'false')
                        console.log('isTrue: ', isTrue)
                        $('#sQuestion').html(data)
                        setIsOK(isTrue)
            
                    }   
                
                })

            }

            if(step == 2){

                $.ajax({

                    url: "/project/functions/check-user-id.php",
                    method: "POST",
                    data: {op: "check_answer",id: $('#reset-id').val(), ans: $('#question-ans').val()},
                    success: function(data){
            
                        console.log("data: " + data)
                        isOK = (data === 'true')
                        console.log('isOK: ', isOK)
                        setIsOK(isOK)
            
                    }   
                
                })


            }

            setTimeout(()=>{

                if(step !== 3 && isOK ){

                    $('input').css('border-color', '#007777');
                    $('.error').remove();
                    step++;

                    if(step == 2){

                        $('#reset-form-1').animate(hideAnimation, 100, () => {
        
                            setTimeout(()=>{
                
                                $('#reset-form-1').css('display', 'none');
                                $('#reset-form-2').css('display', 'block');
                                $('#reset-form-2').animate(showAnimation, 100);
                                $('#reset-form-3').css('display', 'none');
                                $('.prev-btn').show(100);
                                $('.next-btn').show(100);
                
                            }, 500)
                
                        })

                    }

                    if(step == 3){

                        $('#reset-form-2').animate(hideAnimation, 100, () => {
        
                            setTimeout(()=>{
                
                                $('#reset-form-1').css('display', 'none');
                                $('#reset-form-2').css('display', 'none');
                                $('#reset-form-3').css('display', 'block');
                                $('#reset-form-3').animate(showAnimation, 100);
                                $('.prev-btn').show(100);
                                $('.next-btn').hide(100);
                                
                            }, 500)
                
                        })

                        $('#form-action-btn').val('Reset')
                        $('#form-action-btn').show(500)
                        $('#form-action-btn').animate(showAnimation, 100)

                    }
                }else {

                    if($('#reset-id').val() == "")
                        errorDisplay('#reset-id', 'User ID', 'empty')
                    if(step == 1)
                        errorDisplay('#reset-id', 'User ID', 'notValid')

                    if(step == 2)
                        errorDisplay('#question-ans', 'Answer', 'notMatch')

                }


            }, 1000)

        }


    })
    
    $('.prev-btn').click(function() {

        if(step > 1){

            step--
            progress -= 33.33
            $('.progress').css('width', progress + "%")

        }

        if(step == 1){

            if(currentPage == "Register"){
    
                $('#register-form-2').animate(hideAnimation, 100, () => {
    
                    setTimeout(()=>{
        
                        $('#register-form-1').css('display', 'block');
                        $('#register-form-1').animate(showAnimation, 100);
                        $('#register-form-2').css('display', 'none');
                        $('#register-form-3').css('display', 'none');
                        $('.prev-btn').hide(100);
                        $('.next-btn').show(100);
                        
                    }, 500)
        
                })

            }

            if(currentPage == 'Reset'){

                $('input').css('border-color', '#007777');
                $('.error').remove();

                $('#reset-form-2').animate(hideAnimation, 100, () => {
    
                    setTimeout(()=>{
        
                        $('#reset-form-1').css('display', 'block');
                        $('#reset-form-1').animate(showAnimation, 100);
                        $('#reset-form-2').css('display', 'none');
                        $('#reset-form-3').css('display', 'none');
                        $('.prev-btn').hide(100);
                        $('.next-btn').show(100);
                        
                    }, 500)
        
                })

            }

        }

        if(step == 2){

            if(currentPage == 'Register'){

                $('#form-action-btn').animate(hideAnimation, 100, () => {
    
                    setTimeout(()=>{$('#form-action-btn').hide()}, 500)
        
                })
    
                $('#register-form-3').animate(hideAnimation, 100, () => {
    
                    setTimeout(()=>{
        
                        $('#register-form-1').css('display', 'none');
                        $('#register-form-2').css('display', 'block');
                        $('#register-form-2').animate(showAnimation, 100);
                        $('#register-form-3').css('display', 'none');
                        $('.prev-btn').show(100);
                        $('.next-btn').show(100);
                        
                    }, 500)
        
                })

            }    

            if(currentPage == 'Reset'){

                $('input').css('border-color', '#007777');
                $('.error').remove();

                $('#form-action-btn').animate(hideAnimation, 100, () => {
    
                    setTimeout(()=>{$('#form-action-btn').hide()}, 500)
        
                })
    
                $('#reset-form-3').animate(hideAnimation, 100, () => {
    
                    setTimeout(()=>{
        
                        $('#reset-form-1').css('display', 'none');
                        $('#reset-form-2').css('display', 'block');
                        $('#reset-form-2').animate(showAnimation, 100);
                        $('#reset-form-3').css('display', 'none');
                        $('.prev-btn').show(100);
                        $('.next-btn').show(100);
                        
                    }, 500)
        
                })


            }

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
   
    $('#new-profile-label').click((e)=>{

        $('#new-profile-path').change((e)=>{
            
            var file = e.target.files[0];
            var path = URL.createObjectURL(file);
            // var defaultPath = "../public/images/icon-add-128.png"
            var re = /.png|.jpg|.jpeg/i;
            if(file.name.search(re) !== -1){
                
                console.log('path: ', path);
                $('#new-profile-error').css('opacity', '0');
                $('#profile-img').attr('src', path);

            }else {

                console.log('error')
                e.value = '';
                $('#profile-img').attr('src', '');
                $('#new-profile-error').css('opacity', '1');
                // errorDisplay('#profile-path', 'Image', 'notValid');

            }

        })

    })

    $('#new-pw-error').css({'opacity': '0', 'position': 'relative'});
    $('#new-nickname-error').css({'opacity': '0', 'position': 'relative'});
    $('#new-email-error').css({'opacity': '0', 'position': 'relative'});

    $('#update-profile-btn').click(function () {

        let isOk = true

        let regex =  /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*))@([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}$/ 

        $('#new-pw-error').css('opacity', '0');
        $('#new-nickname-error').css('opacity', '0');
        $('#new-email-error').css('opacity', '0');

        if($('#new-pw').val() != $('#new-confirm-pw').val() || ($('#new-pw').val().length < 8 && $('#new-pw').val().length > 1)){

            $('#new-pw-error').css('opacity', '1');
            isOk = false

        }
        
        if($('#new-nickname').val().length == 0){

            $('#new-nickname-error').css('opacity', '1');
            isOk = false
        
        }else if(!($('#new-nickname').val().match(/^[A-Z]+[a-z]*\s*([A-Z]+[a-z]*\s*)*$/))){

            $('#new-nickname-error').css('opacity', '1');
            isOk = false;

        }
        
        if($('#new-email').val() != 0 && !($('#new-email').val().match(regex))){

            $('#new-email-error').css('opacity', '1');
            isOk = false

        }
        
        if(isOk){

            profileForm.submit();

        }

    })


})
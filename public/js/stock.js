$('document').ready(function () {
    
    // disable enter to submit
    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

    const getID = (id) => {
        
        var pattern = /\d/g
        var index = id.search(pattern)
        id = id.substring(index)
        
        return id;
        
    }

    const isValid = () => {

        var isCorrect = true

        var errBorder = {"border": "1px solid red", 'border-radius': '5px'}
        var normalBorder1 = {"border": "1px solid #007777"}
        var normalBorder2 = {"border": "none"}

        $('#new-product-name').css(normalBorder1)
        $('#new-product-des').css(normalBorder1)
        $('#new-gender').css(normalBorder1)
        $('#new-price').css(normalBorder1)
        $('.checkbox-container').css(normalBorder2)
        $('.color-list').css(normalBorder2)

        if($('#new-product-name').val() == ""){

            isCorrect = false;
            $('#new-product-name').css(errBorder)
            
        }

        if($('#new-product-des').val() == ""){

            isCorrect = false;
            $('#new-product-des').css(errBorder)

        }

        if($('#new-gender').val() == ""){

            isCorrect = false;
            $('#new-gender').css(errBorder)

        }

        if($('#new-price').val().length == 0){

            isCorrect = false;
            $('#new-price').css(errBorder)

        }

        if(!($('#xxl').is(':checked')) && !($('#xl').is(':checked')) && !($('#l').is(':checked'))
            && !($('#m').is(':checked')) && !($('#s').is(':checked'))
            && !($('#xs').is(':checked')) && !($('#xxs').is(':checked'))){

                isCorrect = false;

                $('.checkbox-container').css(errBorder)

            }

        var allColorInput = $('.color-input');

        if(allColorInput.length < 1){

            isCorrect = false;
            $('.color-list').css(errBorder)

        }

        return isCorrect;
            

    }

    var currentColor = "#000000"

    const editFunction = () => {

        $('#close-product-window').click(function(){

            $('.edit-modal').animate(
    
                {
                    "z-index": -1, 
                    "opacity": 0, 
                    "top": "50px"
                }, 
                500, 
                ()=>{}

            )

        })

        $('.toggle-btn-1').click(function () {

            if(!$('.toggle-btn-1').hasClass('toggle-btn-active')){
                $('.toggle-btn-1').toggleClass('toggle-btn-active')
                $('.toggle-btn-2').toggleClass('toggle-btn-active')
            }
            $('#edit-panel-1').css({"display": "block"})
            $('#edit-panel-2').css({"display": "none"})
            
    
        })
    
        $('.toggle-btn-2').click(function () {

            if(!$('.toggle-btn-2').hasClass('toggle-btn-active')){
                $('.toggle-btn-1').toggleClass('toggle-btn-active')
                $('.toggle-btn-2').toggleClass('toggle-btn-active')
            }
            $('#edit-panel-1').css({"display": "none"})
            $('#edit-panel-2').css({"display": "block"})
            
    
        })
        
        $('#product-color-picker').change(function(){

           currentColor = $('#product-color-picker').val()
           //console.log(currentColor)

        })

        $('#add-color-btn').click(function() {

            var newColor = "<li class='color-item'><div class='selected-color' style='background: " + currentColor +"'></div><input type='hidden' name='newColors[]' class='color-input' value='"+currentColor+"'></li>"
            var allColorInput = $('.color-input');
            var isAppend = true

            for(var i = 0; i < allColorInput.length; i++){

                console.log("currentColor: ", currentColor)
                console.log("input[i]: ", $(allColorInput[i]).val())
                //console.log("match(?): ", currentColor.match((allColorInput[i]).val()))

                if((currentColor.match($(allColorInput[i]).val())))
                    isAppend = false
                    //break;
                
            }

            if(allColorInput.length < 1 || isAppend)
                $('.color-list').append(newColor)

        })

        $(document).on('click', '.selected-color', function() {

            console.log('clicked')
            $(this).parent().remove()

        })

        

        $('#update-product-btn').click(function() {

            console.log('clicked')
            if(isValid()){
    
                $('#update-product-btn').attr('type', 'submit')
                productForm.submit()
    
            }
    
        })


    }
    
    $('.open-edit-btn').click(function() {

        var id = getID($(this).attr('id'))

        $.ajax({

            url: "/project/public/edit-modal.php",
            method: "POST",
            context: this,
            data: {op: "edit_product", id: id},
            success: function(data){
                
                $('.edit-modal').html(data)
                editFunction()

                $('#edit-new-image-btn').click(() => {

                    console.log('clicked');
        
                    $('#new-img-path').change((e)=>{
                    
                        var file = e.target.files[0];
                        var path = URL.createObjectURL(file);
                        // var defaultPath = "../public/images/icon-add-128.png"
                        console.log(file.name);
                        var re = /.png|.jpg|.jpeg/i;
                        if(file.name.search(re) !== -1){
                            
                            $('#new-profile-error').css('opacity', '0');
                            $('#new-product-img').attr('src', path);
        
                        }else {
        
                            console.log('error')
                            e.value = '';
                            $('#new-product-img').attr('src', 'https://cdn-icons.flaticon.com/png/512/4533/premium/4533754.png?token=exp=1636781807~hmac=3934e632eed8c743be888b915aca3f7c');
                            $('#new-profile-error').css('opacity', '1');
                            // errorDisplay('#profile-path', 'Image', 'notValid');
        
                        }
                        
                    })
        
                })

            }                
            
        })

        $('#edit-panel-1').css({"display": "block"})
        $('#edit-panel-2').css({"display": "none"})
        
        $('.edit-modal').animate(
            
            {
                "z-index": 1000, 
                "opacity": 1, 
                "top": "0px"
            }, 
            500, 
            ()=>{}
        )

        
    })

    $('#add-product-btn').click(function(){

        var img = $(this).children('#new-product-img');

        $.ajax({

            url: "/project/public/edit-modal.php",
            method: "POST",
            context: this,
            data: {op: "add_product"},
            success: function(data){
                
                $('.edit-modal').html(data)
                //console.log(data)
                editFunction(); 
                // $('#new-product-img').attr('src', '');
                $('#edit-new-image-btn').click(() => {

                    console.log('clicked');

        
                    $('#new-img-path').change((e)=>{
                    
                        var file = e.target.files[0];
                        var path = URL.createObjectURL(file);
                        // var defaultPath = "../public/images/icon-add-128.png"
                        console.log(file.name);
                        var re = /.png|.jpg|.jpeg/i;
                        if(file.name.search(re) !== -1){
                            
                            $('#new-profile-error').css('opacity', '0');
                            $('#new-product-img').attr('src', path);
        
                        }else {
        
                            console.log('error')
                            e.value = '';
                            $('#new-product-img').attr('src', 'https://cdn-icons.flaticon.com/png/512/4533/premium/4533754.png?token=exp=1636781807~hmac=3934e632eed8c743be888b915aca3f7c');
                            $('#new-profile-error').css('opacity', '1');
                            // errorDisplay('#profile-path', 'Image', 'notValid');
        
                        }
                        
                    })
        
                })

            }                
            
        })

        $('#edit-panel-1').css({"display": "block"})
        $('#edit-panel-2').css({"display": "none"})
        
        $('.edit-modal').animate(
            
            {
                "z-index": 1000, 
                "opacity": 1, 
                "top": "0px"
            }, 
            500, 
            ()=>{}
        )

    })


    $('.delete-product-btn').click(function() {

        var id = getID($(this).attr('id'))

        $.ajax({

            url: "/project/functions/admin-functions.php",
            method: "POST",
            data: {op: "delete_product",id: id},
            success: function(data){

                console.log("data: " + data)
                location.reload();

            }                

        })

    })
    
    
})
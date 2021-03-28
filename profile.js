$("#editusernameform").submit(function(event){
    //   prevent default php processing
    
        event.preventDefault();
    
    //   collect user input
    
        var datatopost= $(this).serializeArray();
         //console.log(datatopost);
    //   send them to signup.php using ajax
    
            $.ajax({
    
                url:"updateusername.php",
    
                type:"POST",
    
                data: datatopost,
    //      AJAX call suxccessful: show error or succss message
                success: function(data){
    
                    if(data){
    
                        $("#usernameEditmessage").html(data);
    
                    }else{
                        location.reload();
                    }
    
                },
    //      AJAX call fails :show AJAX call error
                error: function(){
    
                 $("#usernameEditmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
    
                }
    
            });
    });

    // Ajax call to updatepassword.php
$("#updatepasswordform").submit(function(event){ 
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
//    console.log(datatopost);
    //send them to updateusername.php using AJAX
    $.ajax({
        url: "updatepassword.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            if(data){
                $("#passwordEditmessage").html(data);
            }
        },
        error: function(){
            $("#passwordEditmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            
        }
    
    });

});

$("#updateemailform").submit(function(event){ 
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
//    console.log(datatopost);
    //send them to updateusername.php using AJAX
    $.ajax({
        url: "updateemail.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            if(data){
                $("#emailEditmessage").html(data);
            }
        },
        error: function(){
            $("#emailEditmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            
        }
    
    });

});
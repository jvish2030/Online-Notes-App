//ajax call for signup form

//  once tghe form is submitted

$("#signupform").submit(function(event){
//   prevent default php processing

    event.preventDefault();

//   collect user input

    var datatopost= $(this).serializeArray();
	 //console.log(datatopost);
//   send them to signup.php using ajax

        $.ajax({

            url:"signup.php",

            type:"POST",

            data: datatopost,
//      AJAX call suxccessful: show error or succss message
            success: function(data){

                if(data){

                    $("#signupmessage").html(data);

                }

            },
//      AJAX call fails :show AJAX call error
            error: function(){

             $("#signupmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");

            }

        });
});








//AJAX call for login form
$("#loginform").submit(function(event){
//   prevent default php processing

    event.preventDefault();

//   collect user input

    var datatopost= $(this).serializeArray();
	// console.log(datatopost);
//   send them to signup.php using ajax

        $.ajax({

            url:"login.php",

            type:"POST",

            data: datatopost,
//      AJAX call suxccessful: show error or succss message
            success: function(data){

            if(data == "success"){
          window.location="mainpage.php";
            }else{
                $('#loginmessage').html(data);   
            }

            },
//      AJAX call fails :show AJAX call error
            error: function(){
 $("#loginmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            }

        });
});

//AJAX call for forgot password form
$("#ForgotPassword").submit(function(event){
    //   prevent default php processing
    
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
//    console.log(datatopost);
    //send them to signup.php using AJAX
    $.ajax({
        url: "forgotpassword.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            
            $('#forgotpasswordmessage').html(data);
        },
        error: function(){
            $("#forgotpasswordmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            
        }
    
    });

});
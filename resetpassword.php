<?php

//<!--the user is redirect to this file after clicking the activation link-->

//<!--signup link contaion two get parameters: email and activation key-->

session_start();

include('connection.php');

?>



<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Reset password form</title>

        <link href="css1/bootstrap.min.css" rel="stylesheet">

        <style>

            h1{

                color:purple;   

            }

            .contactForm{

                border:1px solid #7c73f6;

                margin-top: 50px;

                border-radius: 15px;

            }

        </style> 



    </head>

        <body>

<div class="container-fluid">

    <div class="row">

        <div class="col-sm-offset-1 col-sm-10 contactForm">

            <h1>Password Reset</h1>

            <div id="resultmessage">

            </div>

<?php

//<!--if email or activation key is missing show an error-->

if(!isset($_GET['user_id']) || !isset($_GET['key'])){

        echo '<div class="alert alert-danger">There was an error. Please click on the link you received by email.</div>'; exit;



}

            

//<!--else-->

//<!--    store them in a two var -->

$user_id=$_GET['user_id'];

$key=$_GET['key'];

$time=time()-86400;

//<!--    prepare var for query-->

$user_id = mysqli_real_escape_string($link,$user_id);

$key= mysqli_real_escape_string($link,$key);



//<!--    run query: set activation field to "activated" for the provided email-->

$sql = "SELECT * FROM forgot_password WHERE       `user_id`='$user_id' AND `r_key`='$key' AND `time`>'$time' AND `status`='pending'";

if(!$result=mysqli_query($link,$sql)){

    echo '<div class="alert alert-danger">Error running the query!</div>'; 

    exit;

}

$count = mysqli_num_rows($result);



if($count !== 1){

    echo '<div class="alert alert-danger">Please try again.</div>';

    exit;

}



echo "

<form method='post' id='passwordreset'>



<input type='hidden' name='key' value='$key'>

<input type='hidden' name='user_id' value='$user_id'>



<div class='form-group'>

<label for='password'>Enter your new Password:</label>

<input type='password' name='password' id='password' placeholder='Enter Password' class='form-control'>

</div>



<div class='form-group'>

    <label for='password2'>Re-enter Password::</label>

    <input type='password' name='password2' id='password2' placeholder='Re-enter Password' class='form-control'>

</div>



<input type='submit' name='resetpassword' class='btn btn-success btn-lg' value='Reset Password'>



</form>

"





?>

    

        </div>

    </div>

</div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

        <script src="js1/bootstrap.min.js"></script>

 <script>

    //ajax call to store reset password.php

     $("#passwordreset").submit(function(event){

    //   prevent default php processing

    

    event.preventDefault();

    //collect user inputs

    var datatopost = $(this).serializeArray();

//    console.log(datatopost);

    //send them to signup.php using AJAX

    $.ajax({

        url: "storeresetpassword.php",

        type: "POST",

        data: datatopost,

        success: function(data){

            

            $('#resultmessage').html(data);

        },

        error: function(){

            $("#resultmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");

            

        }

    

    });



});

        </script>

        </body>

</html>


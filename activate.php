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
        <title>Activationt Form</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
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
    
            <h1>Activation Form:</h1>
<?php
//<!--if email or activation key is missing show an error-->
if(!isset($_GET['email']) and !isset($_GET['key'])){
        echo '<div class="alert alert-danger">There was an error. Please click on the link you received by email.</div>'; exit;

}
            
//<!--else-->
//<!--    store them in a two var -->
$email=$_GET['email'];
$key=$_GET['key'];

//<!--    prepare var for query-->
$email = mysqli_real_escape_string($link,$email);
$key= mysqli_real_escape_string($link,$key);

//<!--    run query: set activation field to "activated" for the provided email-->
$sql = "UPDATE users SET email='$email', activation='activated' WHERE (email='$email' AND activation='$key') LIMIT 1";
if(!$result=mysqli_query($link,$sql)){
    echo '<div class="alert alert-danger">There was an error inserting the users details in the database!</div>'; 
    exit;
}elseif(mysqli_affected_rows($link) == 1){
//<!--    if query is successful, show success msg and invite user to login  -->
    echo '<div class="alert alert-success">Your email has been updated.</div>';
     echo '<a href="mainpage.php" type="button" class="btn-lg btn-sucess">Log in<a/>';
}else{
//<!--        else-->
//<!--   show error msg-->
     echo '<div class="alert alert-danger">Your email could not be updated. Please try again later.</div>';
    echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
}
?>
    
        
</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        </body>
</html>

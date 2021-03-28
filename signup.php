<?php
//<!--start session-->
session_start();
//<!--connect to the database-->
include('connection.php');
//
//<!--check user input-->
//<!--    define error msg-->
$missingUsername='<p><strong>Please enter a username!</strong></p>';
$missingEmail='<p><strong>Please enter your email address!</strong></p>';
$invalidEmail = '<p><strong>Please enter a valid email address!</strong></p>';
$missingPassword='<p><strong>Please enter a Password!</strong></p>';
$invalidPassword='<p><strong>Your password should be at least 6 characters long and inlcude one capital letter and one number!</strong></p>';
$differentPassword='<p><strong>Passwords don\'t match!</strong></p>';
$missingPassword2='<p><strong>Please confirm your password</strong></p>';


//<!--    get username, email, pass1, pass2-->
//get username
if(empty($_POST['username'])){
    $errors.=$missingUsername;
}else{
    $username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
}

//GET EMAIL
if(empty($_POST['email'])){
    $errors .= $missingEmail;
}else{
    $email= filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidEmail;
    }
}

//get password
if(empty($_POST['password'])){
    $errors .= $missingPassword;
}elseif(!(strlen($_POST['password'])>6 and preg_match('/[A-Z]/',$_POST['password']) and preg_match('/[0-9]/',$_POST['password']))){
    $errors.=$invalidPassword;
}else{
 $password=filter_var($_POST['password'],FILTER_SANITIZE_STRING);
    if(empty($_POST['password2'])){
        $errors.=$missingPassword2;
    }else{
        $password2=filter_var($_POST['password2'],FILTER_SANITIZE_STRING);
      
        if($password !== $password2){
            $errors.=$differentPassword;
        }
      }
}

//<!--    if there are any error print error-->
if($errors){
    $resultMessage='<div class="alert alert-danger">'.$errors.'</div>';
    echo $resultMessage;
    exit;
}


//<!--no errors-->
//<!--    prepare variable for the queries-->
$username = mysqli_real_escape_string($link,$username);
$email = mysqli_real_escape_string($link,$email);
$password = mysqli_real_escape_string($link,$password);

//$password = md5($password);
$password = hash('sha256', $password);
//128 bits -> 32 characters
//256 bits -> 64 characters

//<!--    if username exist in the user table print error-->
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($link,$sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!</div>';
    echo '<div class="alert alert-danger">'. mysqli_error($link) .'</div>';
    exit;
}else{
    $results = mysqli_num_rows($result);
    if($results){
          echo '<div class="alert alert-danger">That username is already registered. Do you want to log in?</div>';  exit;  
    }
}

//<!--            if email exist in the user table print error-->
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($link,$sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!</div>';
     echo '<div class="alert alert-danger">'. mysqli_error($link) .'</div>';
    exit;
}else{
    $results = mysqli_num_rows($result);
    if($results){
          echo '<div class="alert alert-danger">That email is already registered. Do you want to log in?</div>';  exit;  
    }
}


//<!--        else-->
//<!--                create a unique activation code-->
$activationkey = bin2hex(openssl_random_pseudo_bytes(16));
//byte: unit of data = 8 bits
    //bit: 0 or 1
    //16 bytes = 16*8 = 128 bits
    //(2*2*2*2)*2*2*2*2*...*2
    //16*16*...*16
    //32 characters

//<!--                    insert user detail activation code in the user table-->
$sql = "INSERT INTO users (`username`,`email`,`password`,`activation`,`activation2`) VALUES('$username','$email','$password','$activationkey','')";
if(!$result=mysqli_query($link,$sql)){
     echo '<div class="alert alert-danger">There was an error inserting the users details in the database!</div>'; 
    exit;
}

//<!--                     sent the user an email with link to activate.php with their email and activation code-->
$message = "Please click on this link to activate your account:\n\n";
$message .= "http://technophilic.host20.uk/activate.php?email=". urlencode($email)."&key=$activationkey";

    if(mail($email,'Confirm your Registration',$message,'from:'.'jatinv.cse@sbjit.edu.in')){
        echo "<div class='alert alert-success'>Thank for your registring! A confirmation email has been sent to $email. Please click on the activation link to activate your account.</div>";
        echo "<div class='alert alert-info'>Check your Email (Spam) for link.</div>";
    }
?>
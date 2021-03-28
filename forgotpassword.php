<?php
// <!--start session-->

// <!--connect to the database-->
include('connection.php');

// <!--check user input-->
// <!--    define error msg-->
$missingEmail = '<p><strong>Please enter your email address!</strong></p>';
$invalidEmail = '<p><strong>Please enter a valid email address!</strong></p>';

// <!--    get email-->
// <!--    store errors in the error variable-->

if(empty($_POST["forgotemail"])){
    $errors .= $missingEmail;   
}else{
    $email = filter_var($_POST["forgotemail"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidEmail;   
    }
}

// <!--    if there are any error print error-->
// <!--no errors-->
if($errors){
    $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
    echo $resultMessage;
    exit;
}
// <!--    prepare variable for the queries-->
 $email =mysqli_real_escape_string($link,$email);

// // <!--    run query: check combination of email and password exists-->
 $sql = "SELECT * FROM users WHERE email='$email'";
 $result = mysqli_query($link,$sql);
 if(!$result){
     echo '<div class="alert alert-danger">Error running the query!</div>'; exit;
 }
 else{
     echo "success";
 }

 $count = mysqli_num_rows($result);
//If the email does not exist
            //print error message
if($count != 1){
    echo '<div class="alert alert-danger">That email does not exist on our database!</div>';  exit;
}
        
        //else
            //get the user_id
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$user_id = $row['user_id'];
$user_id = mysqli_real_escape_string($link,$user_id);
            //Create a unique  activation code
$r_key = bin2hex(openssl_random_pseudo_bytes(16));
            //Insert user details and activation code in the forgotpassword table
$time =  time();
$status = 'pending';




$sql = "INSERT INTO forgot_password (`user_id`,`r_key`,`time`,`status`)
        VALUES 
        ('$user_id', '$r_key', '$time', '$status')";
if(!$result=mysqli_query($link,$sql)){
    echo '<div class="alert alert-danger">There was an error inserting the users details in the forgot table database!</div>'; 
   exit;
}





//Send email with link to resetpassword.php with user id and activation code

            $message = "Please click on this link to reset your password:\n\n";
            $message .= "http://technophilic.host20.uk/resetpassword.php?user_id=$user_id&key=$r_key";
if(mail($email, 'Reset your password', $message, 'From:'.'jatinv.cse@sbjit.edu.in')){
        //If email sent successfully
                //print success message
       echo "<div class='alert alert-success'>An email has been sent to $email. Please click on the link to reset your password.</div>";
       echo "<div class='alert alert-info'>Check your Email (Spam) for link.</div>";
}


//  $count = mysqli_num_rows($result);
// // // <!--    if email don't match print error-->
// // // <!--    else-->
//  if($count != 1){
//      echo '<div class="alert alert-danger">That email does not exist on our database!</div>';  exit;
//  }
// // // <!--           get the user id-->
//  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
//  $userid = $row['user_id']
// // // <!--           create unique activation code-->
//  $key = bin2hex(openssl_random_pseudo_bytes(16));
// //  //Insert user details and activation code in the forgotpassword table
//   $time=time();
//   $status='panding';
// // // <!--           enter user deatis and activation code in the forgot password table-->
//  $sql = "INSERT INTO forgotpassword (`user_id`,`rkey`,`time`,`status`) VALUES ('$userid','$key','$time','$status')";
//  $result = mysqli_query($link,$sql);
//  if(!$result){
//      echo '<div class="alert alert-danger">Error running the query!</div>'; exit;
//  }
// // // <!--           send email withb link to reset password.php with user id and activation code-->
//  $message .= "Please click on this link to reset your password:\n\n";
//  $message .= "http://technophilic.host20.uk/resetpassword.php?user_id=$user_id&key=$key";
//  if(mail($email,'Reset Your password',$message,'from:'.'jatinv.cse@sbjit.edu.in')){
// // // <!--                 if email sent successful-->
// // // <!--                        print success-->
//  echo "<div class='alert alert-success'>An email has been sent to $email. Please click on the link to reset your password.</div>";
//  }

?>
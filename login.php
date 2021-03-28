<?php
//<!--start session-->
session_start();
//<!--connect to the database-->
include('connection.php');
//
//
//<!--check user input-->
//<!--    define error msg-->
$missingEmail= '<p><stong>Please enter your email address!</strong></p>';
$missingPassword='<p><stong>Please enter your password!</strong></p>'; 

//<!--    get email and password-->
//<!--    store errors in the error variable-->
if(empty($_POST['email'])){
    $errors .= $missingEmail;
}else{
    $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
}
if(empty($_POST['password'])){
    $errors .= $missingPassword;
}else{
    $password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
}

//<!--    if there are any error print error-->
if($errors){
    $resultMessage='<div class="alert alert-danger">'.$errors.'</div>';
    echo $resultMessage;
    exit;
}else{
    //<!--no errors-->
//<!--    prepare variable for the queries-->
    $email = mysqli_real_escape_string($link,$email);
     $password = mysqli_real_escape_string($link,$password);
    $password = hash('sha256', $password);
    
    //<!--    run query: check combination of email and password exists-->
    $sql="SELECT * FROM users WHERE email='$email' AND password ='$password' AND  activation ='activated'";
    if(!$result = mysqli_query($link,$sql)){
        echo '<div class="alert alert-danger">Error running the query!</div>';
    echo '<div class="alert alert-danger">'. mysqli_error($link) .'</div>';
    exit;
    }
    
    //<!--    if email and password don't match print error-->
    $count = mysqli_num_rows($result);
    if($count !== 1){
        echo '<div class="alert alert-danger">Wrong Username or Password</div>';
        exit;
    }else{
        //<!--    else-->
//<!--            log the user in: Set session variable--
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $_SESSION['user_id']=$row['user_id'];
        $_SESSION['username']=$row['username'];
        $_SESSION['email']=$row['email'];
        
        //<!--             if remember me is not checked-->
        if(empty($_POST['rememberme'])){
            //<!--                    print success-->
             echo "success"; 
        }else{
            //<!--             else-->
//<!--                create 2 var $authinticator1 & $authinticator2-->
        $authinticator1=bin2hex(openssl_random_pseudo_bytes(10));
        $authinticator2=openssl_random_pseudo_bytes(20);
//<!--                STORE them in a cookie-->
             function f1($a, $b){
            $c = $a . "," . bin2hex($b);
            return $c;
             }
            
           $cookieValue = f1($authinticator1,$authinticator2);
            
            setcookie(
            "rememberme",
            $cookieValue,
            time() + 2147483647
        );
//<!--                run query to store them in remember table-->
            function f2($a){
                $b = hash('sha256',$a);
                return $b;
            }
           
            $f2authinticator2 = f2($authinticator2);
            $user_id = $_SESSION['user_id'];
            $expiration =date('Y-m-d H:i:s', time() + 2147483647);
           
            
            $sql = "INSERT INTO rememberme
            (`authenticator1`, `f2authenticator2`, `user_id`, `expires`)
        VALUES
        ('$authinticator1', '$f2authinticator2', '$user_id', '$expiration')";
            
            $result = mysqli_query($link,$sql);
            
            
//<!--                 if query unsuccessful-->
//<!--                        print error-->
//<!--                 else-->
//<!--                        print success-->
                    if(!$result){
                        echo  '<div class="alert alert-danger">There was an error storing data to remember you next time.</div>';  

                    }else{
                        echo "success";
                                                
                    }
            
        }
        
    }
}

?>
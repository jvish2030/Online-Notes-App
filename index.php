<?php
    session_start();
    include('connection.php');
    //logout
    include('logout.php');

    //remember me
   // echo  "<div class='alert alert-danger'>Cookie:" . $_COOKIE['rememberme'] . " ....User_id :" . $_SESSION['user_id'] . "</div>";
    include('rememberme.php');

?>
<!DOCTYPE html>
 <html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro&family=Merriweather&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Online Notes App</title>
  </head>
  <body>
   

<header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-warning">
        <a class="navbar-brand" href="#" style="font-weight:700;">Online notes</a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="material-icons" style="font-size:30px;color:black;opacity: 0.5;">
apps
</span>
        </button>
        
        
        <div class="navbar-collapse collapse" id="navbarCollapse" style="">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="#" style="color:black;">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Help</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="contact.php">contact-us</a>
      </li>
    </ul>
      </div>

      </nav>
    </header>

<!--jumbotron -->
  <div class="jumbotron" id="mycontainer">
      <h1 class="display-4">Online Notes App</h1>
      <p class="lead">Your Notes with you wherever you go.</p>
      <hr class="my-4">
      <p>Easy to use protect all your notes.</p>
      <div class="row justify-content-md-center">
      <div class="col-md-8">
                    <p>
                    <button type="button" class="btn btn-success btn-lg signup" data-toggle="modal" data-target="#myModal">Sign up</button>
                    <button type="button" class="btn btn-success btn-lg signup" data-toggle="modal" data-target="#loginModal">&nbsp;Login&nbsp;</button>
                    </p>
                </div>
        </div>        
  </div>

<!-- login form -->
  
<form method="post" id="loginform">
      <!-- Button trigger modal -->
<div class="container mt-3">
 
  <!-- Button to Open the Modal -->
  
  <!-- The Modal -->
  <div class="modal fade" id="loginModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Login</h4>
          <button type="button" class="close" data-dismiss="modal"><span class="material-icons">
              close</span></button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
       <!--  signupmessage from php file -->
         <div id="loginmessage">
             
         </div>
         
          <div class="form-group">
             
             <label for="emaillogin" class="sr-only">email</label>
              <input class="form-control" type="email" name="email" placeholder="Email-address" id="emaillogin" maxlength="50">
             
             <label for="passwordlogin" class="sr-only">password</label>
              <input class="form-control" type="password" name="password" placeholder="Enter a password" id="passwordlogin" maxlength="30">
              <input type="checkbox" onclick="myFunction2()"> Show Password

<script>
function myFunction2() {
  var x = document.getElementById("passwordlogin");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
          </div>
          

          <div class="form-check">
                <label>
                <input  name="rememberme" type="checkbox" class="form-check-input" id="rememberme">Remember me.
              </label>
                  
                    <a class="float-right" data-target="#forgotpasswordModal" data-toggle="modal" style="cursor: pointer;" data-dismiss="modal">Forgot password?</a>
        </div>
    </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
         <button type="button" class="btn btn-default float-left" style="margin-right: auto;" data-dismiss="modal" data-target="#myModal" data-toggle="modal">Register</button>
          <input class="btn btn-success" name="login" value="login" type="submit"> 
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          
        </div>
        
      </div>
    </div>
  </div>
  
</div>
 
   </form>
   
<!-- sign up form -->
   <form method="post" id="signupform">
      <!-- Button trigger modal -->
<div class="container mt-3">
 
  <!-- Button to Open the Modal -->
  
  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Sign up today and Start using our Online Notes App!</h4>
          <button type="button" class="close" data-dismiss="modal"> <span class="material-icons">
              close</span></button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
       <!--  signupmessage from php file -->
         <div id="signupmessage">
             
         </div>
         
          <div class="form-group">
             <label for="username" class="sr-only">username</label>
              <input class="form-control" type="text" name="username" placeholder="Username" id="username" maxlength="30">
             
             <label for="email" class="sr-only">email</label>
              <input class="form-control" type="email" name="email" placeholder="Email-address" id="email" maxlength="50">
             
             <label for="password1" class="sr-only">password1</label>
              <input class="form-control" type="password" name="password" placeholder="Choose a password" id="password1" maxlength="30">
              
              <label for="password2" class="sr-only">password2</label>
              <input class="form-control" type="password" name="password2" placeholder="Confirm password" id="password2" maxlength="30">
              <br>
              <input type="checkbox" onclick="myFunction()"> Show Password

<script>
function myFunction() {
  var x = document.getElementById("password1");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
    var x = document.getElementById("password2");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
          </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <input class="btn btn-success" name="signup" value="signup" type="submit"> 
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>
 
   </form>
   
  <!-- 
   forgot password form -->
   
   <form method="post" id="ForgotPassword">
    <!-- Button trigger modal -->
<div class="container mt-3">

<!-- Button to Open the Modal -->

<!-- The Modal -->
<div class="modal fade" id="forgotpasswordModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Forgot Password? Enter your email address.</h4>
        <button type="button" class="close" data-dismiss="modal"><span class="material-icons">
              close</span></button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
     <!--  signupmessage from php file -->
       <div id="forgotpasswordmessage">
           
       </div>
       
        <div class="form-group">
           
           <label for="forgotemail" class="sr-only">email</label>
            <input class="form-control" type="email" name="forgotemail" placeholder="Email-address" id="forgotemail" maxlength="50">
           
        </div>
      </div>     
      <!-- Modal footer -->
      <div class="modal-footer">
       <button type="button" class="btn btn-default float-left" style="margin-right: auto;" data-dismiss="modal" data-target="#myModal" data-toggle="modal">Register</button>
        <input class="btn btn-success" name="submit" value="submit" type="submit"> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        
      </div>
      
    </div>
  </div>
</div>

</div>

 </form>
  

 <div class="container-fluid text-center footer bg-warning text-white" style=" width: 100%;
    position:fixed;
    left:0px;
    bottom:0px;
    height: auto;
    margin: auto;
    line-height: 20px;
    text-align:center;
      font-size:17px;
      color:black;
   ">
   <p class="text-muted">Devloped by-Jatin Vishwakarma Copyright&copy; 2020-2021</p>
</div>
   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="index.js"></script>
  </body>
</html>
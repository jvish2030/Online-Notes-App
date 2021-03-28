<?php
  session_start();
  include('connection.php');
  if(!isset($_SESSION['user_id'])){
    header("location: index.php");
  }
$id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE user_id='$id'";
$result = mysqli_query($link,$sql);

if(!$result){
  echo '<div class="alert alert-danger">Error running the query!</div>';
}

$count = mysqli_num_rows($result);

if($count == 1){
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $username = $row['username'];
    $_SESSION['username']= $username;
    $email = $row['email']; 
}else{
 
  echo '<div class="alert alert-danger">There was an error retrieving the username and email from the database</div>';
}
?>

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
    <title>Proflie</title>
    <style>
       .container{
            margin-top: 80px;
        }
        tr{
            cursor: pointer;
        }
      </style>
  </head>
  <body>
   
      <!--  Navigation bar -->

<header>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-warning">
  <a class="navbar-brand" href="#" style="font-weight: bold;margin-right: 70px;">Online Notes</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="material-icons" style="font-size:30px;color:black;opacity: 0.5;">
apps
</span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link " href="#">Profile <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link text-info" href="#">Help</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link text-info" href="contact.php">contact-us</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link text-info" href="mainpage.php">My-notes</a>
      </li>
    </ul>
   
    <form class="form-inline my-2 my-lg-0" >
         <a class="form-control mr-sm-2 text-success" style="text-decoration: none; background-color: transparent;">Logged in as <b><?php echo $_SESSION['username']; ?></b></a>
          <a class="btn btn-outline-success my-2 my-sm-0" href="index.php?logout=1">Log out</a>
    </form>
     </div>
</nav> 
      </header>
<!--Container -->
<div class="container">
    <div class="row">
        <div class="offset-md-3 col-md-6">
              <h2>General Account Setting:</h2>
<table class="table table-hover my-4">
   
    <tbody>
      <tr data-target="#updateusername" data-toggle="modal">
        <td>Username</td>
        <td><?php echo $username; ?></td>
        
      </tr>
      <tr data-target="#updateemail" data-toggle="modal">
        <td>Email</td>
        <td><?php echo $email; ?></td>
       
      </tr>
      <tr  data-target="#updatepassword" data-toggle="modal">
        <td>Password</td>
        <td>hidden</td>
      </tr>
    </tbody>
  </table>
  
        </div>
    </div>
</div>

<!-- modal username -->
 <form mathod="post" id="editusernameform">
      <!-- Button trigger modal -->
<div class="container mt-3">
 
  <!-- Button to Open the Modal -->
  
  <!-- The Modal -->
  <div class="modal fade" id="updateusername">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Username:</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
     
         <div id="usernameEditmessage">
             
         </div>
         
          <div class="form-group">
             
             <label for="username" >Username:</label>
              <input class="form-control" type="text" name="username" id="username" maxlength="30" value="<?php echo $username; ?>">              
          </div>
          

    
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <input class="btn btn-success" name="submit" value="submit" type="submit"> 
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          
        </div>
        
      </div>
    </div>
  </div>
  
</div>
 
   </form>
  
  <!-- modal email -->
 <form mathod="post" id="updateemailform">
      <!-- Button trigger modal -->
<div class="container mt-3">
 
  <!-- Button to Open the Modal -->
  
  <!-- The Modal -->
  <div class="modal fade" id="updateemail">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Enter new email:</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
       <!--  signupmessage from php file -->
         <div id="emailEditmessage">
             
         </div>
         
          <div class="form-group">
             
             <label for="email" >Email:</label>
              <input class="form-control" type="email" name="email" id="email" maxlength="50" value="<?php echo $email; ?>">              
          </div>
          

    
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <input class="btn btn-success" name="submit" value="submit" type="submit"> 
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          
        </div>
        
      </div>
    </div>
  </div>
  
</div>
 
   </form>
   
   <!-- modal password -->
 <form mathod="post" id="updatepasswordform">
      <!-- Button trigger modal -->
<div class="container mt-3">
 
  <!-- Button to Open the Modal -->
  
  <!-- The Modal -->
  <div class="modal fade" id="updatepassword">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Enter current and New password:</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
       <!--  signupmessage from php file -->
         <div id="passwordEditmessage">
             
         </div>
         
          <div class="form-group">
             
             <label for="currentpassword" class="sr-only">Your current password:</label>
              <input class="form-control" type="password" name="currentpassword" id="currentpassword" maxlength="30" placeholder="Your current password">       
              
                      <label for="newpassword" class="sr-only">new password:</label>
              <input class="form-control" type="password" name="newpassword" id="newpassword" maxlength="30" placeholder="New password">         
              
                      <label for="confirmpassword" class="sr-only">confirm password:</label>
              <input class="form-control" type="password" name="confirmpassword" id="confirmpassword" maxlength="30" placeholder="Confirm password">                
          </div>
          

    
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <input class="btn btn-success" name="submit" value="submit" type="submit"> 
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          
        </div>
        
      </div>
    </div>
  </div>
  
</div>
 
   </form>
   
<!--   footer-->
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
    <script src="profile.js"></script>
  </body>
</html>
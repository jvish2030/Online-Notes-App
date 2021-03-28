<?php
   session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
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
     <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <title>MY Notes</title>
    <style>
        .container{
            margin-top: 100px;
           
        }
        #notepad,#allnote,#Done,.delete,#save{
            display: none;
        }
        .buttons{
            margin-bottom: 20px;
        }
        textarea{
            width: 100%;
            max-width: 100%;
            font-size: 16px;
            line-height: 1.5em;
            border-left-width: 20px;
            border-color: rgba(255, 152, 11, 0.86);
            background-color: rgba(255, 234, 204, 0.85);
            color: #744393;
            padding: 10px;
        }
        .noteheader{
            border:1px solid grey;
            border-radius:10px;
            margin-bottom:10px;
            cursor:pointer;
            padding: 0px 10px;
            background: linear-gradient(#FFFFFF,#ECEAE7);
        }
        .text{
          font-size:20px;
            overflow: hidden;
            white-space:nowrap;
            text-overflow:ellipsis;
        }
        .timetext{
            overflow: hidden;
            white-space:nowrap;
            text-overflow:ellipsis;
        }
        #notes{
          max-height: 400px;
            overflow-y: scroll;
        }
        .material-icons{}
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
      <li class="nav-item">
        <a class="nav-link text-success" href="profile.php">Profile <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link text-info" href="#">Help</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link text-info" href="contact.php">contact-us</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">My-notes</a>
      </li>
    </ul>
   
<!--
         <ul class="navbar-nav list-group list-group-horizontal ">
        <li class="nav-item list-group-item " style="background-color: transparent;">
            <a class="text-success" href="" style="text-decoration: none;">Logged in as <b>Username</b></a>
        </li>
        
        <li class="nav-item list-group-item " style="margin-left: auto;background-color: transparent">
             <button type="button" 
             class="btn btn-outline-success float-right" style="font-weight: 700;"  ><a href="index.php?logout=1" >Log out</a></button>
             <a type="button" class="btn btn-outline-success float-right" href="index.php?logout=1">Log out</a>
        </li>
    </ul>   
-->
    
    <form class="form-inline my-2 my-lg-0" >
         <a class="form-control mr-sm-2 text-success" style="text-decoration: none; background-color: transparent;">Logged in as <b><?php echo $_SESSION['username']; ?></b></a>
          <a class="btn btn-outline-success my-2 my-sm-0" href="index.php?logout=1">Log out</a>
    </form>
    
     </div>
</nav> 
</header>

<!--Container -->
<div class="container" id="container">
        <div id="alert" class="alert alert-danger collapse">
          <a class="close" data-dismiss="alert">&times;</a>
          <p id="alertcontent"></p>
        </div>
    <div class="row">
  <div class="offset-md-3 col-md-6">
      <div class="buttons">
            <button type="button" id="addnote" class="btn btn-info btn-lg"><i class='fas fa-plus-circle'></i>&nbsp;Add Notes</button>
          
            <button type="button" id="edit" class="btn btn-info btn-lg float-right">Edit	&nbsp;<i class='far fa-edit'></i></button>
            
            <button type="button" id="Done" class="btn btn-success btn-lg float-right"><i class='far fa-check-circle'></i>&nbsp;Done</button>
            
            <button type="button" id="save" class="btn btn-success btn-lg float-right"><i class='far fa-check-circle'></i>&nbsp;Save</button>
              
            <button type="button" id="allnote" class="btn btn-info btn-lg"> <i class='far fa-arrow-alt-circle-left'></i> 	&nbsp;All Notes</button>
      </div>
     
          <div id="notepad">
              <textarea rows="10">
              </textarea>
          </div>
          
          <div id="notes" class="notes">
<!--              Ajax call to php file to retrive notes from database-->
          </div>
      
  </div>
</div>
</div>


   
<!--   footer-->
<div class="container-fluid text-center footer bg-warning" style=" width: 100%;
    position:fixed;
    left:0px;
    bottom:0px;
    height: auto;
    margin: auto;
    line-height: 20px;
    text-align:center;
      font-size:17px;
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
    <script src="mynotes.js">
        
    </script>
  </body>
</html>
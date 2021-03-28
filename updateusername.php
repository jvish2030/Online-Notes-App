<?php
session_start();
    $user_id = $_SESSION['user_id'];
    include('connection.php');
    $username = $_POST['username'];

    $sql = "UPDATE users SET username='$username' WHERE user_id='$user_id' ";
    $result = mysqli_query($link, $sql);
    if(!$result){
        echo '<div class="alert alert-danger">There was an error updating storing the new username in the database!</div>';
    }
?>
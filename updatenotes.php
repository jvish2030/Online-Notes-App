<?php
    session_start();
    include('connection.php');

    //get the user id
    $id=$_POST['id'];
    //get the conntent of the user
    $note = $_POST['note'];
    //get the time
    $time = time();
    //run a querry to update a note
    $sql = "UPDATE notes SET note='$note' , time='$time' WHERE  id='$id'";
    $result = mysqli_query($link, $sql);
    if(!$result){
        echo 'error';   
    }
?>
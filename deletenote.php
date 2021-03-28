<?php
    session_start();
    include('connection.php');
  
    //get the user id
    $id=$_POST['id'];

    //run a querry to delete a note
    $sql = "DELETE FROM notes WHERE id='$id'";
    $result = mysqli_query($link, $sql);
if(!$result){
    echo 'error';   
}
?>
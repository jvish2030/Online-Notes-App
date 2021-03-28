<?php
$link=mysqli_connect('localhost','technoph_notes','gC7e07AtyS','technoph_onlineNotes');
if(mysqli_connect_error()){
    die('ERROR : Unable to connect:' . mysqli_connect_error());
        echo "<script>window.alert('Hi!')</script>";

}
?>
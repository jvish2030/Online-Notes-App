<?php
   
   session_start();
    include('connection.php');
     
    //get the user id
    $userid = $_SESSION['user_id'];
    
    //run a query to delete empty notes
    $sql = "DELETE FROM notes WHERE note=''";
    $result = mysqli_query($link,$sql);
    if(!$result){
        echo '<div class="alert alert-warning">An error occured!</div>'; exit;
    }
    //run a query to look for notes corresponding to user id
    $sql = "SELECT * FROM notes WHERE user_id ='$userid' ORDER BY time DESC";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $note_id = $row['id'];
                $note = $row['note'];
                $time = $row['time'];
                date_default_timezone_set("Asia/Kolkata"); 

                $time =date('F d, Y h:i:s A', $time);
                
                echo "
                <div class='note'>
                    <div class='col-5 col-sm-3 col-md-5 delete'>
                        <button class='btn-lg btn-danger' style='width:100%;'><i class='far fa-times-circle'></i>&nbsp;Delete </button>
                    </div>
                <div class='noteheader ' id='$note_id'>
                    <div class='text'>$note</div>
                    <div class='timetext'>$time</div>   
            </div>
            </div>";
            }
        }else{
            echo 'error';
            exit;
        }
        
    }else{
        echo '<div class="alert alert-warning">An error occured!</div>';
        exit;
    //    echo "ERROR: Unable to excecute: $sql." . mysqli_error($link);
    }
    
    ?>
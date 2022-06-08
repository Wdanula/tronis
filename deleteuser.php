<?php session_start();?>
<?php  require_once('connection.php');  ?>
<?php  require_once('functions.php');  ?>

<?php

//Checking if user is logged in
if(!isset($_SESSION['user_id'])){
  header('Location:login.php');
}


    if(isset($_GET['user_id'])){
        $user_id = mysqli_real_escape_string($connection,$_GET['user_id']);
        
        if($user_id == $_SESSION['user_id']){
            header('Location:customerlist.php?cannot_delete_current_user');
        }else{
            //User deleting 
            $query = "UPDATE user SET is_deleted = 1 WHERE id={$user_id} LIMIT 1";
            
            $result = mysqli_query($connection , $query);
            if($result){
                header('Location:customerlist.php?user_deleted');
            }else{
                header('Location:customerlist.php?user_delete_fail');
            }
        }

    }else{
        header('Location:customerlist.php');
    }

    
 ?>   
<?php mysqli_close($connection);?>

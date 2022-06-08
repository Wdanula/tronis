<?php session_start();?>
<?php  require_once('connection.php');  ?>
<?php  require_once('functions.php');  ?>

<?php
$admin_id = '';
//Checking if user is logged in
if(!isset($_SESSION['admin_id'])){
  header('Location:adminloggin.php');
}


    if(isset($_GET['admin_id'])){
        $admin_id = mysqli_real_escape_string($connection,$_GET['admin_id']);
       
        if($admin_id == $_SESSION['admin_id']){
           header('Location:adminlist.php?cannot_delete_current_user');
          
        }else{
            //User deleting 
            $query = "UPDATE adminlist SET is_deleted = 1 WHERE id ={$admin_id} LIMIT 1";
            
            $result = mysqli_query($connection , $query);
            if($result){
                header('Location:adminpanel.php?admin_deleted');
            }else{
                header('Location:adminlist.php?admin_delete_fail');
            }
        }

    }else{
        header('Location:adminlist.php');
    }

    
 ?>   
<?php mysqli_close($connection);?>

<?php session_start();?>
<?php  require_once('connection.php');  ?>
<?php  require_once('functions.php');  ?>

<?php
$admin_id = '';
//Checking if user is logged in
if(!isset($_SESSION['admin_id'])){
  header('Location:adminloggin.php');
}


    if(isset($_GET['product_id'])){
        $admin_id = mysqli_real_escape_string($connection,$_GET['product_id']);
       
       
            // deleting 
            $query = "UPDATE products SET stock_available = 1 WHERE id ={$admin_id} LIMIT 1";
            
            $result = mysqli_query($connection , $query);
            if($result){
                header('Location:shopforadmin.php?admin_deleted');
            }else{
                header('Location:shopforadmin.php?admin_delete_fail');
            }
        

    }else{
        header('Location:shopforadmin.php');
    }
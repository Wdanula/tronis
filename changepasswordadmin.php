<?php session_start();?>
<?php  require_once('connection.php');  ?>
<?php  require_once('functions.php');  ?>

<?php

//Checking if user is logged in
if(!isset($_SESSION['admin_id'])){
  header('Location:adminloggin.php');
}



    $errors = array();
    $admin_id='';
    $first_name = '';
    $last_name = '';
    $email = '';
    

    if(isset($_GET['admin_id'])){
        $admin_id = mysqli_real_escape_string($connection,$_GET['admin_id']);
        $query = "SELECT * FROM adminlist WHERE id = {$admin_id} LIMIT 1";
        $result_set = mysqli_query($connection,$query);
        if($result_set){
                if(mysqli_num_rows($result_set)==1){
                //user found
                $result = mysqli_fetch_assoc($result_set);
                $first_name =$result['first_name'] ;
                $last_name =$result['last_name'] ;
                //$username = '';
                $email =$result['email'] ;
                }
                else{
                //user not found
                header('Location:adminlist.php?user_not_found');
                }
            }
            else
            {
                //if query unsuccessful redirect customerlist.php
                header('Location:adminlist.php?error_query_failed');
            }
    }
    

    if(isset($_POST['submit'])){
       
    $admin_id =$_POST['admin_id'];
    $password =$_POST['password'];
    // $first_name = $_POST['first_name'];
    // $last_name = $_POST['last_name'];
    // $email = $_POST['email'];
    // echo "ok";
    // die();
      //Check required feilds
      $req_fields = array('admin_id','password');
      $errors = array_merge($errors,check_req_fields($req_fields));

      //Check max lenth of fields
    $max_length_fields = array('password'=>50);
    $errors = array_merge($errors,check_max_length($max_length_fields));
    //Check it is a correct email address
    // if(!is_email($_POST['email'])){
    //     $errors[]='Email Address Is Invalid';
    //   }
    
    //check if email address is already exists
    // $email = mysqli_real_escape_string($connection,$_POST['email']);
    // $query = "SELECT * FROM adminlist WHERE email = '{$email}'AND id !={$admin_id} LIMIT 1";
    // $result_set = mysqli_query($connection,$query);
   
    //                             if($result_set){
    //                                 if(mysqli_num_rows($result_set)==1){
    //                                     $errors[] = ' The email address is already exists';
    //                                 }
    //                             }
                                if(empty($errors)){
                                    //no errors found
                                    $password = mysqli_real_escape_string($connection,$_POST['password']);
                                    //$last_name = mysqli_real_escape_string($connection,$_POST['last_name']);
                                    //$username = mysqli_real_escape_string($connection,$_POST['username']);
                                    //$phonenumber = mysqli_real_escape_string($connection,$_POST['phonenumber']);
                                    //$address1 = mysqli_real_escape_string($connection,$_POST['address']);
                                    //$address2 = mysqli_real_escape_string($connection,$_POST['address']);
                                   //$password = mysqli_real_escape_string($connection,$_POST['password']);
                              
                                    //$hashed_password = sha1($password);
                              
                                  //   $query = "INSERT INTO user (";
                                  //   $query .= "first_name, last_name,email,is_deleted";
                                  //   $query .= ") VALUES (";
                                  //   $query .= "'{$first_name}','{$last_name}','{$email}',0";
                                  //   $query .= ")";
                                  
                                  $hashed_password = sha1($password);
                                  $query = "UPDATE adminlist SET  password='{$hashed_password}' WHERE id={$admin_id} LIMIT 1";
                                  //  $query = "UPDATE adminlist SET ";
                                  //  $query .= "password = '{$hashed_password}'";
                                  //  $query .= "WHERE id='{$admin_id}' LIMIT 1";
                                   
                                    $result = mysqli_query($connection,$query);
                                    if($result){
                                        //query is successful redirect to adminlist page
                                        header("Location:adminlist.php?user_modified=true");
                                        
                                    }else{
                                      $errors[]='Feaild to update the password';
                                    }
                                  }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#showpassword').click(function(){
                if( $('#showpassword').is(':ckecked')){
                  $('#password').attr('type','text');
                }else{
                  $('#password').attr('type','password');
                }
            });
        });
      </script>  
</head>
<body>
    <!-- Start Of Section-1 -->
    <section>
      <div class="container-1">
        <p class="text">Text some thing</p>
        <span class="icons">
            <span class="icon1"><i class="fab fa-facebook-square fa-lg"></i></span>
            <span class="icon2"><i class="fab fa-instagram fa-lg"></i></span>
        </span>
    </div>
    </section>
  <!-- End Of Section-1 -->

  <!-- Start Of Section 2 -->
    <section>
      <div class="container-2">
        <div class="name">
          <span>TRONIC SPACE</span>
        </div>
        <!-- <div class="tooltips">
          <span class="tip1">tooltip1</span>
        </div> -->
        <div class="menu">
          <span class="menu-items-1"><a href="./index.php">Home</a></span>
          <span class="menu-items-1"><a href="./shop.php">Shop</a></span>
          <span class="menu-items-1"><a href="./userregistration.php">Register</a></span>
          <span class="menu-items-1"id="login">Login</span>
          <!-- <span class="menu-items-1"><i class="fas fa-search"onclick="enable()"></i></span> -->
          <span class="menuAll"><i class="fas fa-bars fa-lg"></i></span>
          <div class="menuIcons">
            <span class="micons micons-1"><i class="fas fa-home fa-lg"><p class="home">home</p></i></span>
            <span class="micons"><i class="fas fa-shopping-bag fa-lg"><p class="shop">shop</p></i></span>
            <span class="micons"><i class="fas fa-user fa-lg"><p class="account">account</p></i></span>
            <!-- <span class="micons"><i class="fas fa-question fa-lg"><p class="help">help</p></i></span> -->
            <!-- <span class="micons"><i class="fas fa-search fa-lg"id="searchicon" onclick="enable()"><p class="search">search</p></i></span> -->
          </div>
        </div>
       
      </div>
    </section>
  <!-- End Of Section-2 -->

  <!-- Start Of Section 3 -->

    <div class="login">
        <div class="form">
            <fieldset>
                <form action="changepasswordadmin.php" method="post" >
                  <input type="hidden"name="admin_id"value="<?php echo $admin_id;?>">
                    <h3 class="loginTitle">Change Password</h3>
                    <?php
                      if(isset($errors) && !empty($errors)){
                        echo '<div class="error"><p>Invalid Username Or Password</p></div>';
                      }
                    ?>
                    <div class="detailsLogin">
                        <div class="left-part">
                            <p>
                                <label for="">First Name</label>
                                <input type="text"name="first_name"<?php echo 'value="'. $first_name.'"';?> disabled    >
                            </p>
                            <p>
                               <label for="">Last Name</label>
                               <input type="text"name="last_name"<?php echo 'value="'. $last_name.'"';?> disabled    >
                             </p>
                             <p>
                                 <label for="">Email</label>
                                 <input type="text"name="email"<?php echo 'value="'. $email.'"';?> disabled    >
                             </p>
                             <p>
                                 <label for="">New Password</label>
                                 <input type="password"name="password"id="password">
                             </p>
                             <p>
                                 <label for="">Show Password</label><br>
                                 <input type="checkbox"name="showpassword"id="showpassword"style="width:30px;height:30px;">
                             </p>
                        </div>
                        <div class="right-part">
                            <!-- <p>
                                <label for="">Phone Number</label>
                                <input type="text">
                            </p>
                            <p>
                                <label for="">Address</label>
                                <input type="text">
                            </p>
                            <p>
                                <label for="">Address</label>
                                <input type="text">
                            </p>
                            <p>
                                <label for="">Password</label>
                                <input type="text">
                            </p> -->
                           
                        </div>
                    </div>
                    <p>
                        <input type="submit"name="submit" value="Update Password">
                    </p>
                </form>
            </fieldset>
    </div>

  <!-- End Of Section 3 -->



    <!-- Start Of Container 4 -->
    <section>
        <!-- <hr> -->
        <div class="container-4">
            <div class="contacts">
                <div class="address addres-1">
                  <h4>Our Malambe Shop</h4>
                  <p><i class="fas fa-store-alt"></i> 160/7H, New Kandy Road, Pittugala, Malabe</p>
                  <p><i class="fas fa-phone-alt"></i> Email:infor@tronicspace.com</p>
                  <p><i class="fas fa-clock"></i> Mon - Fri / 9:00 AM - 6:00 PM</p>
                  <p><i class="fas fa-clock"></i> Sat / 9:00 AM - 5:00 PM</p>
                  <p><i class="fas fa-clock"></i> Sunday & Poya Day Closed</p>
                </div>
                <div class="address address-2">
                  <h4>Our Katubedda Shop</h4>
                  <p><i class="fas fa-store-alt"></i> 2/2, Bandaranayake Mawatha, Katubedda, Moratuwa</p>
                  <p><i class="fas fa-phone-alt"></i> 0712452696 / 0759454098</p>
                  <p><i class="fas fa-clock"></i> Mon - Fri / 9:00 AM - 6:00 PM</p>
                  <p><i class="fas fa-clock"></i> Sat / 9:00 AM - 5:00 PM</p>
                  <p><i class="fas fa-clock"></i> Sunday & Poya Day Closed</p>
                </div>
                <div class="address bankCards">
                  <h3>We Accept</h3>
                   <img class="image"src="./bankcards.png" alt=""width="250px"> 
                </div>
            </div>
        </div>
      </section>
      <!-- End Of Container -4  -->
      <section>
        <div class="container-5">
          <div class="copy">
            <p>Designed & Developed By Danula Sahitha | &copy; TronicSpace </p>
          </div>
        </div>
      </section>
      <!-- <script src="jquery.js"></script> -->
      <script src="./main.js"></script>
    </body>
    </html>
    <?php mysqli_close($connection);?>
    
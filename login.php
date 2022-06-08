<?php session_start();?>
<?php  require_once('connection.php');  ?>
<?php  require_once('functions.php');  ?>
<?php

$errors = array();
    $user_id='';
    $first_name = '';
    $last_name = '';
    $email = '';
    $user_list = '';
    
  $query = "SELECT * FROM user WHERE is_deleted=0 ORDER BY first_name";
  $users = mysqli_query($connection,$query);

  $user_details =mysqli_fetch_assoc($users);
  $user_id = $user_details['id'];


  // check for submission
    if(isset($_POST['submit'])){

      $errors = array();

  // username or password has been entered
      if(!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1){
          $errors[] = 'Username is missing or Invalid';
      }
      if(!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1){
        $errors[] = 'Password is missing or Invalid';
    }

  // Check if any errors in the form
    if(empty($errors)){
         //save usename and passwor into veriable
          $email = mysqli_real_escape_string($connection,$_POST['email']);
          $password = mysqli_real_escape_string($connection,$_POST['password']);
          $hashed_password = sha1($password);

        //prepaer databace query
        $query = "SELECT * FROM user
                  WHERE email = '{$email}' 
                  AND password ='{$hashed_password}'
                  LIMIT 1";
        $result_set = mysqli_query($connection,$query);
        
        verify_query($result_set);
          // query successful
            if(mysqli_num_rows($result_set)==1){ 
              //valid user found
              $user =mysqli_fetch_assoc($result_set);
              $_SESSION['user_id'] = $user['id'];
              $_SESSION['first_name'] = $user['first_name'];
              
              //Update last loggin
              $query = "UPDATE user SET last_login = NOW()";
              $query .="WHERE id= {$_SESSION['user_id']} LIMIT 1";
              $result_set = mysqli_query($connection,$query);

              verify_query($result_set);

              // Redirect to index.php
              header('Location:myprofile.php');
            }else{
              // user name and password invalid
              $errors[] ='Invalid username or password';
            }

        
        // Check if the user is valid

        

       //if not, Display the error
    }
  }
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./style.css">
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
            <span class="micons micons-1"><a href="./index.php"><i class="fas fa-home fa-lg"><p class="home">home</p></i></a></span>
            <span class="micons"><a href="./shop.php"><i class="fas fa-shopping-bag fa-lg"><p class="shop">shop</p></i></a></span>
           <span class="micons"><a href="./userregistration.php"><i class="fas fa-registered"><p class="account">Register</p></i></a></span>
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
                <form action="login.php" method="post" >
                    <h3 class="loginTitle">User Login</h3>
                    <?php
                      if(isset($errors) && !empty($errors)){
                        echo '<div class="error"><p>Invalid Username Or Password</p></div>';
                      }
                    ?>
                    <div class="detailsLogin">
                        <div class="left-part">
                            <p>
                                <label for="">Username</label>
                                <input type="text"name="email">
                            </p>
                            <p>
                               <label for="">Password</label>
                               <input type="password"name="password">
                             </p>
                             <!-- <p>
                                 <label for="">Username</label>
                                 <input type="text">
                             </p>
                             <p>
                                 <label for="">Email</label>
                                 <input type="text">
                             </p> -->
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
                        <input type="submit"name="submit" value="Sign In">
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
          
      <script src="./main.js"></script>
    </body>
    </html>
    <?php mysqli_close($connection);?>
    
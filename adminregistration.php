<?php session_start();?>
<?php  require_once('connection.php');  ?>
<?php  require_once('functions.php');  ?>

<?php

if(!isset($_SESSION['admin_id'])){
  header('Location:adminloggin.php');
}

$errors = array();

    $first_name = '';
    $last_name = '';
    // $username = '';
    $email = '';
    $password = '';
    $phonenumber = '';
    // $address1 = '';
    // $address2 = '';

    if(isset($_POST['submit'])){

      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      // $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $phonenumber = $_POST['phone_number'];
      // $address1 = $_POST['address'];
      // $address2 = $_POST['address'];
  
        //Check required feilds
        $req_feilds = array('first_name','last_name','email','password','phone_number');
        foreach($req_feilds as $field){
          if(empty(trim($_POST[$field]))){
            $errors[] = $field.' Is Required';
          }
        }
  
        //Check max lenth of fields
      $max_length_fields = array('first_name'=>100,'last_name'=>100,'email'=>50,'password'=>50,'phone_number'=>20);
      foreach($max_length_fields as $field => $max_len){
        if(strlen(trim($_POST[$field]))> $max_len){
          $errors[] = $field.' Must be less than'.$max_len .' characters.';
        }
      }
      //Check it is a correct email address
      // if(!is_email($_POST['email'])){
      //     $errors[]='Email Address Is Invalid';
      //   }
  
      //check if email address is already exists
      $email = mysqli_real_escape_string($connection, $_POST['email']);
      $query = "SELECT * FROM adminlist WHERE email = '{$email}'LIMIT 1";
      $result_set = mysqli_query($connection,$query);
  
      if($result_set){
        if(mysqli_num_rows($result_set)==1){
            $errors[] = ' The email address is already exists';
        }
      }
  
      if(empty($errors)){
        //no errors found
        $first_name = mysqli_real_escape_string($connection,$_POST['first_name']);
        $last_name = mysqli_real_escape_string($connection,$_POST['last_name']);
        // $username = mysqli_real_escape_string($connection,$_POST['username']);
        $phonenumber = mysqli_real_escape_string($connection,$_POST['phone_number']);
        // $address1 = mysqli_real_escape_string($connection,$_POST['address']);
        // $address2 = mysqli_real_escape_string($connection,$_POST['address']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);
  
        $hashed_password = sha1($password);
  
        $query = "INSERT INTO adminlist (";
        $query .= "first_name, last_name,email ,password,phone_number, is_deleted";
        $query .= ") VALUES (";
        $query .= "'{$first_name}','{$last_name}','{$email}','{$hashed_password}','{$phonenumber}', 0";
        $query .= ")";
  
        $result = mysqli_query($connection,$query);
        if($result){
            //query is successful redirect to user login page
            header("Location:adminloggin.php?user_added=true");
        }else{
          $errors[]='Feaild to add the new record';
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
    <title>Admin Register</title>
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
          <!-- <span class="menu-items-1">Home</span>
          <span class="menu-items-1">Shop</span> -->
          <span class="menu-items-1"><a href="./adminpanel.php">Back To Dashboard</a></span>
          <span class="menu-items-1"><a href="adminlogout.php">Sign Out</a></span>
          <!-- <span class="menu-items-1"><i class="fas fa-search"onclick="enable()"></i></span> -->
          <span class="menuAll"><i class="fas fa-bars fa-lg"></i></span>
          <div class="menuIcons">
            <!-- <span class="micons micons-1"><i class="fas fa-home fa-lg"><p class="home">home</p></i></span>
            <span class="micons"><i class="fas fa-shopping-bag fa-lg"><p class="shop">shop</p></i></span> -->
            <span class="micons"><a href="./adminpanel.php"><i class="fas fa-users-cog"><p class="shop">Dashboard</p></i></a></span>
            <!-- <span class="micons"><i class="fas fa-question fa-lg"><p class="help">help</p></i></span> -->
            <!-- <span class="micons"><i class="fas fa-search fa-lg"id="searchicon" onclick="enable()"><p class="search">search</p></i></span> -->
          </div>
        </div>
       
      </div>
    </section>
  <!-- End Of Section-2 -->


  <!-- Start Of Section 3 -->
    <section>
        <!-- <div class="container-3">
            <div class="searchBox"><input id="searchBox3" class="inputsearch" placeholder="search here" type="text"></div>
        </div> -->
        <div class="container-user">
            <div class="form">
                <fieldset>
                    <form action="adminregistration.php" method="post" >
                        <h3 class="registration">Admin Registration</h3>
                        <?php
                          if(!empty($errors)){
                            echo '<div class="errors">';
                            echo 'There were error(s) in your form </br>';
                            foreach($errors as $error){
                              echo $error .'</br>';
                            }
                            echo '</div>';
                          }
                        ?>
                        <div class="details">
                            <div class="left-part">
                                <p>
                                    <label for="">First Name</label>
                                    <input type="text"name="first_name"<?php echo 'value="'. $first_name.'"';?>>
                                </p>
                                <p>
                                   <label for="">Last Name</label>
                                   <input type="text"name="last_name"<?php echo 'value="'. $last_name.'"';?>>
                                </p>
                                 <!-- <p>
                                     <label for="">Username</label>
                                     <input type="text">
                                 </p> -->
                                 <p>
                                     <label for="">Email</label>
                                     <input type="text"name="email"<?php echo 'value="'.$email .'"';?>>
                                 </p>
                            </div>
                            <div class="right-part">
                                <p>
                                    <label for="">Phone Number</label>
                                    <input type="text"name="phone_number"<?php echo 'value="'. $phonenumber.'"';?>>
                                </p>
                                <!-- <p>
                                    <label for="">Address</label>
                                    <input type="text">
                                </p>
                                <p>
                                    <label for="">Address</label>
                                    <input type="text">
                                </p> -->
                                <p>
                                    <label for="">Password</label>
                                    <input type="password"name="password">
                                </p>
                               
                            </div>
                         </div>
                        <p>
                            <input type="submit" name="submit" value="Sign Up">
                        </p>
                    </form>
                </fieldset>
            </div>
        </div>
    </section>
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
<?php mysqli_close($connection); ?>
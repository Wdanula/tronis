<?php session_start();?>
<?php  require_once('connection.php');  ?>
<?php  require_once('functions.php');  ?>


<?php

   //Checking if user is logged in
if(!isset($_SESSION['user_id'])){
  header('Location:login.php');
}



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

  

    // if(isset($_GET['user_id'])){
    //     $user_id = mysqli_real_escape_string($connection,$_GET['user_id']);
    //     $query = "SELECT * FROM user WHERE id = {$user_id} LIMIT 1";
    //     $result_set = mysqli_query($connection,$query);
    //     if($result_set){
    //             if(mysqli_num_rows($result_set)==1){
    //             //user found
    //             $result = mysqli_fetch_assoc($result_set);
    //             $first_name =$result['first_name'] ;
    //             $last_name =$result['last_name'] ;
    //             //$username = '';
    //             $email =$result['email'] ;
    //             }
    //             else{
    //             //user not found
    //             header('Location:myprofile.php?user_not_found');
    //             }
    //         }
    //         else
    //         {
    //             //if query unsuccessful redirect customerlist.php
    //             header('Location:myprofile.php?error_query_failed');
    //         }
    // }
    

    if(isset($_POST['submit'])){
       
    $user_id =$_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    // echo "ok";
    // die();
      //Check required feilds
      $req_fields = array('first_name','last_name','email');
      $errors = array_merge($errors,check_req_fields($req_fields));

      //Check max lenth of fields
    $max_length_fields = array('first_name'=>50,'last_name'=>100,'email'=>100);
    $errors = array_merge($errors,check_max_length($max_length_fields));
    //Check it is a correct email address
    // if(!is_email($_POST['email'])){
    //     $errors[]='Email Address Is Invalid';
    //   }
    
    //check if email address is already exists
    $email = mysqli_real_escape_string($connection,$_POST['email']);
    $query = "SELECT * FROM user WHERE email = '{$email}'AND id !={$user_id} LIMIT 1";
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
                                   $query = "UPDATE user SET ";
                                   $query .= "first_name = '{$first_name}', ";
                                   $query .= "last_name = '{$last_name}', ";
                                   $query .= "email = '{$email}'";
                                   $query .= "WHERE id='{$user_id}' LIMIT 1";
                                   
                                    $result = mysqli_query($connection,$query);
                                    if($result){
                                        //query is successful redirect to adminlist page
                                        header("Location:edithprofile.php?user_modified=true");
                                        
                                    }else{
                                      $errors[]='Feaild to modification the new record';
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
    <title>Home</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./style.css">
    <style>
       .btn a{
        text-decoration:none;
        color:white;
      }
    </style>
    

</head>
<body>
    <!-- Start Of Section-1 -->
    <section>
      <div class="container-1">
        <p class="text">Welcome <?php echo $_SESSION['first_name']?></p>
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
          <span class="menu-items-1"id="home">Home</span>
          <span class="menu-items-1"><a href="./shopforregisterduser.php">Shop</a></span>
          <span class="menu-items-1"><a href="./edituserprofile.php?user_id=<?php echo $user_id;?>">Edit Profile</a></span>
          <span class="menu-items-1"><a href="./logout.php">Logout</a></span>
          <!-- <span class="menu-items-1"><i class="fas fa-search"onclick="enable()"></i></span> -->
          <span class="menuAll"><i class="fas fa-bars fa-lg"></i></span>
          <div class="menuIcons">
            <span class="micons micons-1"><i class="fas fa-home fa-lg"><p class="home">home</p></i></span>
            <span class="micons"><a href="./shopforregisterduser.php"><i class="fas fa-shopping-bag fa-lg"><p class="shop">shop</p></i></a></span>
            <span class="micons"><a href="./modifyuser.php?user_id=<?php echo $user_id;?>"><i class="fas fa-id-card-alt"><p class="account">My Profile</p></i></a></span>
            <span class="micons"><a href="./login.php"><i class="fas fa-sign-in-alt"><p class="login1">Logout</p></i></a></span>
            <!-- <span class="micons"><i class="fas fa-search fa-lg"id="searchicon" onclick="enable()"><p class="search">search</p></i></span> -->
          </div>
        </div>
       
      </div>
    </section>
  <!-- End Of Section-2 -->
      <div class="section-brands">
   <div class="container-brands"id="brands-1">
         <div class="brands brand1"><img src="./brands/arduino1.png" alt=""style="width:90px;height:50px;"></div>
         <div class="brands brand2"><img src="./brands/atmel.png" alt=""style="width:90px;height:60px;"></div>
         <div class="brands brand3"><img src="./brands/microbit.png" alt=""style="width:90px;height:50px;"></div>
         <div class="brands brand4"><img src="./brands/raspberrypi.png" alt=""style="width:90px;height:60px;"></div>
         <div class="brands brand5"><img src="./brands/texasins.png" alt=""style="width:90px;height:40px;"></div>
         <div class="brands brand6"><img src="./brands/esp32.png" alt=""style="width:90px;height:60px;"></div>
       </div>
</div>
  <!-- Start of section 3 -->
  <section>
    <div class="container-3">
        <!-- <div class="searchBox"><input id="searchBox3" class="inputsearch" placeholder="Search here" type="text"></div> -->
    </div>
    <div class="categories">
      <h2 class="hedding-shop">Categories</h2>
      <div class="sub-categories">
          <div class="card printer">
            <h4>3D Printer And CNC</h4>
            <p class="thingsPrinter"></p>
            <p class="discription">They key difference between 3D printing and CNC machining is that 3D printing is a form of additive manufacturing, whilst CNC machining is subtractive. This means CNC machining starts with a block of material (called a blank), and cuts away material to create the finished part</p>
            <!-- <p class="thingsPrinter"></p>
            <p class="things">Shafts</p>
            <p class="things">Rods</p>
            <p class="things">Bearings</p>
            <p class="things">Nozzels</p>
            <p class="things">Lead Screws</p><br> -->
            <span class="btn btn-1"><a href="./3dprinterandcncforregist.php">Shop Now</a></span>
          </div>
          <div class="card electronic-comp">
            <h4>Electronic Components</h4>
            <p class="thingsElectronics"></p>
            <p class="discription-electronics">An electronic component is any basic discrete device or physical entity in an electronic system used to affect electrons or their associated fields. Electronic components are mostly industrial products, available in a singular form and are not to be confused with electrical elements, which are conceptual abstractions representing idealized electronic components and elements.</p>
            <!-- <p class="things">Transistor</p>
            <p class="things">Capacitor</p>
            <p class="things">Resisitors</p>
            <p class="things">Diodes</p>
            <p class="things">Relay</p>
            <p class="things">LED</p><br> -->
            <span class="btn btn-1"><a href="./electronicforregist.php">Shop Now</a></span>
          </div>
          <div class="card development-boards">
            <h4>Development Boards</h4>
            <p class="thingsDevelopmentBoards"></p>
            <p class="discription">Development boards are made for learning purposes mostly and can also be used in industrial applications as well. In this vast community of electronics there are many custom development boards also available. They are also used for prototyping before releasing the main product.</p>
            <!-- <p class="things">Arduino</p>
            <p class="things">Rassberry PI</p>
            <p class="things">Node MCU</p>
            <p class="things">Micro Bit</p>
            <p class="things">Onion Omega2S+</p>
            <p class="things">LParticle Argon</p><br> -->
            <span class="btn btn-1"><a href="./developmentboardforregist.php">Shop Now</a></span>
          </div>
      </div>
    </div>
  </section>
  <!-- End Of Section 3 -->

  <!-- Start Of Container 4 -->
  <section>
    <hr>
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
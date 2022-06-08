<?php session_start();?>
<?php  require_once('connection.php');  ?>
<?php  require_once('functions.php');  ?>

<?php

if(!isset($_SESSION['user_id'])){
  header('Location:login.php');
}

$errors = array();
    $product_list = '';
    $product_name = '';
    $product_category = '';
    // $username = '';
    $quantity = '';
    $price = '';
    $image_url = '';
    $description = '';
    $product_id ='';
    // $address2 = '';



    
    if(isset($_GET['product_id'])){
        $product_id = mysqli_real_escape_string($connection,$_GET['product_id']);

        $query = "SELECT * FROM products WHERE id = {$product_id} LIMIT 1";
        $result_set = mysqli_query($connection,$query);
        // echo "ok";
        // die();                              <img src=\"images/{$product['image_url']}\">
        if($result_set){
            if(mysqli_num_rows($result_set)==1){
                //user found
                $result = mysqli_fetch_assoc($result_set);
                $product_name =$result['product_name'] ;
                $product_category =$result['product_category'] ;
                $quantity = $result['quantity'] ;
                $price = $result['price'];
                $image_url= $result['image_url'];
                $description = $result['description'];

                // echo $description;
                // die();

                //$email =$result['email'] ;
            }else{
                //user not found
                header("Location:cutomerlist.php?user_not_found");
            }
        }else{
            //if query unsuccessful redirect customerlist.php
            header("Location:cutomerlist.php?error_query_failed");
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
          <span class="menu-items-1"id="home">Home</span>
          <span class="menu-items-1"><a href="./shopforregisterduser.php">Shop</a></span>
          <!-- <span class="menu-items-1"><a href="./userregistration.php">Register</a></span> -->
          <span class="menu-items-1"><a href="./logout.php">Logout</a></span>
          <span class="menu-items-1"><i class="fas fa-search"onclick="enable()"></i></span>
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


  <section>
    <!-- <div class="container-3">
        <div class="searchBox"><input id="searchBox3" class="inputsearch" placeholder="Search here" type="text"></div>
    </div> -->
   
    <div class=" more_details">
        <h2>More Details</h2>
        <h2><?php echo $product_name?></h2>
     <div class="left-details">
         <div class="product-image"><?php echo"<img src=\"images/{$image_url}\">"?></div>
     </div>
     <div class="right-details">
         <p>
              <?php echo $description?>
             <p id="product-price">Rs :<?php echo $price;?></p>
            
        </p>
     </div>
    </div>
    
  </section>
  <!-- End Of Section 3 -->
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


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




  
  $product_list = '';
  // Getting the list of user
  $query = "SELECT * FROM products WHERE stock_available=0 AND product_category ='electronic_components'";    
  $products = mysqli_query($connection,$query);
  
  // echo "ok";
  // die();
  
  verify_query($products);
      if(mysqli_num_rows($products)>0){
        while($product = mysqli_fetch_assoc($products)){
          $product_list .= "<div class=\"grid grid-1\">";
          $product_list .= "<div class=\"product-name\"><p>{$product['product_name']}</P></div>";
          $product_list .= "<div class=\"product-image\"><img src=\"images/{$product['image_url']}\"style=\"width:100px;heihgt:100px;\"></div>";
          $product_list .= "<div class=\"product-discription\"><p>{$product['description']}</P></div>";
          $product_list .= "<div class=\"price\"><span class=\"price-tag\">Rs:{$product['price']}</span></div>";
          $product_list .= "<div class=\"show-details\"><a href=\"moredetails.php?product_id={$product['id']}\"><i class=\"fas fa-info-circle\"></i><span> More Details<span></a></div>";
          // $product_list .= "<td>{$product['description']}</td>";
           $product_list .= "<td><a \" href=\"modifyuser.php?user_id={$product['id']}\"></a></td>";
           $product_list .= "<td><a \" href=\"moredetails.php?product_id={$product['id']}\"></a></td>";
          // $product_list .= "<td><a  href=\"deleteuser.php?user_id={$product['id']}\">Delete</a></td>";
           $product_list .= "</div>";
        }
      }
     
      
?>

    <!-- <div class="grid grid-1">
            <div class="product-image"></div>
            <div class="product-discription">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima et architecto quia at odio magni sint laudantium explicabo in fugiat. Tempore libero a aut distinctio facilis placeat modi consequatur illum?</p>
            </div>
            <div class="price">
            <span class="price-tag">Price Here</span>
            </div>
            <div class="show-details"><a href="#"><i class="fas fa-info-circle"></i><span> More Details<span></a></div>
    </div> -->
    










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronics</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <!-- Start Of Section-1 -->
    <section>
      <div class="container-1">
        <p class="text">Welcome Electronic Section </p>
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
          <span class="menu-items-1"id="shop">Shop</span>
          <span class="menu-items-1"><a href="./logout.php">Logout</a></span>
          <!-- <span class="menu-items-1"><a href="./userregistration.php">Register</a></span> -->
          <!-- <span class="menu-items-1"><a href="./logout.php">Logout</a></span> -->
          <span class="menu-items-1"><i class="fas fa-search"onclick="enable()"></i></span>
          <span class="menuAll"><i class="fas fa-bars fa-lg"></i></span>
          <div class="menuIcons">
            <span class="micons micons-1"><i class="fas fa-home fa-lg"><p class="home">home</p></i></span>
            <span class="micons"><i class="fas fa-shopping-bag fa-lg"><p class="shop">shop</p></i></span>
            <span class="micons"><i class="fas fa-user fa-lg"><p class="account">account</p></i></span>
            <span class="micons"><i class="fas fa-question fa-lg"><p class="help">help</p></i></span>
            <span class="micons"><i class="fas fa-search fa-lg"id="searchicon" onclick="enable()"><p class="search">search</p></i></span>
          </div>
        </div>
       
      </div>
    </section>
  <!-- End Of Section-2 -->

  <!-- Start of section 3 -->
    <section class="section-shop">
    <div class="container-3">
        <div class="searchBox"><input id="searchBox3" class="inputsearch" placeholder="Search here" type="text"></div>
    </div>
    <h2 class="hedding-shop">Electronic Components</h2>
    <div class="product-grid">
      <input type="hidden"name="product_id"value="<?php echo $product_id?>">
    <?php echo $product_list?>
        <!-- <div class="grid grid-1">
            <div class="product-image"></div>
            <div class="product-discription">
                <p></p>
            </div>
            <div class="price">
            <span class="price-tag"></span>
            </div>
            <div class="show-details"><a href="#"><i class="fas fa-info-circle"></i><span> More Details<span></a></div>
        </div> -->
        <!-- <div class="grid grid-2">
            <div class="product-image"></div>
            <div class="product-discription">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima et architecto quia at odio magni sint laudantium explicabo in fugiat. Tempore libero a aut distinctio facilis placeat modi consequatur illum?</p>
            </div>
            <div class="price">
            <span class="price-tag">Price Here</span>
            </div>
            <div class="show-details"><a href="#"><i class="fas fa-info-circle"></i><span> More Details<span></a></div>
        </div>
        <div class="grid grid-3">
            <div class="product-image"></div>
            <div class="product-discription">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima et architecto quia at odio magni sint laudantium explicabo in fugiat. Tempore libero a aut distinctio facilis placeat modi consequatur illum?</p>
            </div>
            <div class="price">
            <span class="price-tag">Price Here</span>
            </div>
            <div class="show-details"><a href="#"><i class="fas fa-info-circle"></i><span> More Details<span></a></div>
        </div>
        <div class="grid grid-4">
            <div class="product-image"></div>
            <div class="product-discription">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima et architecto quia at odio magni sint laudantium explicabo in fugiat. Tempore libero a aut distinctio facilis placeat modi consequatur illum?</p>
            </div>
            <div class="price">
            <span class="price-tag">Price Here</span>
            </div>
            <div class="show-details"><a href="#"><i class="fas fa-info-circle"></i><span> More Details<span></a></div>
        </div>
        <div class="grid grid-5">
            <div class="product-image"></div>
            <div class="product-discription">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima et architecto quia at odio magni sint laudantium explicabo in fugiat. Tempore libero a aut distinctio facilis placeat modi consequatur illum?</p>
            </div>
            <div class="price">
            <span class="price-tag">Price Here</span>
            </div>
            <div class="show-details"><a href="#"><i class="fas fa-info-circle"></i><span> More Details<span></a></div>
        </div>
        <div class="grid grid-6">
            <div class="product-image"></div>
            <div class="product-discription">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima et architecto quia at odio magni sint laudantium explicabo in fugiat. Tempore libero a aut distinctio facilis placeat modi consequatur illum?</p>
            </div>
            <div class="price">
            <span class="price-tag">Price Here</span>
            </div>
            <div class="show-details"><a href="#"><i class="fas fa-info-circle"></i><span> More Details<span></a></div>
        </div>
        <div class="grid grid-7">
            <div class="product-image"></div>
            <div class="product-discription">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima et architecto quia at odio magni sint laudantium explicabo in fugiat. Tempore libero a aut distinctio facilis placeat modi consequatur illum?</p>
            </div>
            <div class="price">
            <span class="price-tag">Price Here</span>
            </div>
            <div class="show-details"><a href="#"><i class="fas fa-info-circle"></i><span> More Details<span></a></div>
        </div>
        <div class="grid grid-8">
            <div class="product-image"></div>
            <div class="product-discription">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima et architecto quia at odio magni sint laudantium explicabo in fugiat. Tempore libero a aut distinctio facilis placeat modi consequatur illum?</p>
            </div>
            <div class="price">
                <span class="price-tag">Price Here <span class="">Stock</span></span> 
            </div>
            <div class="show-details"><a href="#"><i class="fas fa-info-circle"></i><span> More Details<span></a></div>
        </div> -->
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
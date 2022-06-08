<?php session_start();?>
<?php  require_once('connection.php');  ?>
<?php  require_once('functions.php');  ?>
<?php
   
   if(!isset($_SESSION['admin_id'])){
     header('Location:adminloggin.php');
   }
   $product_list = '';
   // Getting the list of user
   $query = "SELECT * FROM products WHERE stock_available=0 ORDER BY product_category";    
   $products = mysqli_query($connection,$query);
     
   verify_query($products);
       if(mysqli_num_rows($products)>0){
         $product = mysqli_fetch_assoc($products);
           $product_id = $product['id'];
      }  
 
      







  //Getting number of admins
  $query = "SELECT * FROM adminlist WHERE is_deleted=0 ORDER BY first_name";
  $result_set = mysqli_query($connection, $query);

  //Getting number of customers
  $query = "SELECT * FROM user WHERE is_deleted=0 ORDER BY first_name";
  $result_customer = mysqli_query($connection, $query);
  
  //Getting number of products
  $query = "SELECT * FROM products  WHERE stock_available=0 ORDER BY product_category";
  $result_products = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./style.css">
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
          <!-- <span class="menu-items-1">Home</span>
          <span class="menu-items-1">Shop</span> -->
          <span class="menu-items-1"><?php echo $_SESSION['first_name']?></span>
          <span class="menu-items-1"><a href="./homeforadmin.php">Home</a></span>
          <span class="menu-items-1"><a href="./shopforadmin.php">Shop</a></span>
          <span class="menu-items-1"><a href="adminlogout.php">Sign Out</a></span>
          <!-- <span class="menu-items-1"><i class="fas fa-search"onclick="enable()"></i></span> -->
          <span class="menuAll"><i class="fas fa-bars fa-lg"></i></span>
          <div class="menuIcons">
            <span class="micons micons-1"><a href="./homeforadmin.php"><i class="fas fa-home fa-lg"><p class="home">home</p></i></a></span>
            <span class="micons"><a href="./shopforadmin.php"><i class="fas fa-shopping-bag fa-lg"><p class="shop">shop</p></i></a></span>
            <span class="micons"><a href="./adminlogout.php"><i class="fas fa-sign-in-alt"><p class="account">Logout</p></i></a></span>
            <!-- <span class="micons"><i class="fas fa-user fa-lg"><p class="account">account</p></i></span> -->
            <!-- <span class="micons"><i class="fas fa-question fa-lg"><p class="help">help</p></i></span> -->
            <!-- <span class="micons"><i class="fas fa-search fa-lg"id="searchicon" onclick="enable()"><p class="search">search</p></i></span> -->
          </div>
        </div>
       
      </div>
    </section>
  <!-- End Of Section-2 -->

  <section>
      <div class="container-admin">
          <h2>Welcome To Tronicspace Dashboard</h2>
          <div class="admin-cards">
            <div class="dashboard userlist">
                <h4>Our Customers</h4>
                <p><i class="fas fa-users"></i></p>               
                <h4>Number Of Customers</h4>
                <h4 ><?php echo mysqli_num_rows($result_customer);?></h4>
                <button><a href="./customerlist.php">Customer Settings</a></button>
            </div>

            <div class="dashboard productlist">
                <h4>Add Products</h4>
                <p><i class="fab fa-product-hunt"></i></p>
                <h4>All Products</h4>
                <h4 ><?php echo mysqli_num_rows($result_products);?></h4>
                <button><a href="./addnewproduct.php">Add Products</a></button>
                <button><a href="./shopforadmin.php">Edit Products</a></button>
                <!-- <button><a href="">Delete Products</a></button> -->
            </div>
            <div class="dashboard adminlist">
                <h4>Admin List</h4>
                <p><i class="fas fa-users-cog"></i></p>
                <h4>Number Of Admins</h4>
                <h4 ><?php echo mysqli_num_rows($result_set);?></h4>
                <button><a href="./adminlist.php">Admin Settings</a></button>
                <button><a href="./adminregistration.php">Add New Admin</a></button>
                <!-- <button><a href="./addnewproduct.php">Add New Product</a></button> -->
            </div>
          </div>  
      </div>
  </section>
</body>
</html>
<?php mysqli_close($connection);?>

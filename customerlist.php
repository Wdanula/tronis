<?php session_start();?>
<?php  require_once('connection.php');  ?>
<?php  require_once('functions.php');  ?>
<?php
  if(!isset($_SESSION['admin_id'])){
    header('Location:adminloggin.php');
  }
  $user_list = '';
  // Getting the list of user
  $query = "SELECT * FROM user WHERE is_deleted=0 ORDER BY first_name";
  $users = mysqli_query($connection,$query);

  verify_query($users);
      while($user = mysqli_fetch_assoc($users)){
        $user_list .= "<tr>";
        $user_list .= "<td>{$user['first_name']}</td>";
        $user_list .= "<td>{$user['last_name']}</td>";
        $user_list .= "<td>{$user['last_login']}</td>";
        $user_list .= "<td><a \" href=\"modifyuser.php?user_id={$user['id']}\">Edit</a></td>";
        $user_list .= "<td><a  href=\"deleteuser.php?user_id={$user['id']}\">Delete</a></td>";
        $user_list .= "</tr>";
      }
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List</title>
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
          <span class="menu-items-1"><a href="">Home</a></span>
          <span class="menu-items-1"><a href="./shopforadmin.php">Shop</a></span>
          <span class="menu-items-1"><a href="./adminpanel.php">My Account</a></span>
          <span class="menu-items-1"><a href="adminlogout.php">Sign Out</a></span>
          <!-- <span class="menu-items-1"><i class="fas fa-search"onclick="enable()"></i></span> -->
          <span class="menuAll"><i class="fas fa-bars fa-lg"></i></span>
          <div class="menuIcons">
            <span class="micons micons-1"><a href="./homeforadmin.php"><i class="fas fa-home fa-lg"><p class="home">home</p></i></a></span>
            <span class="micons"><a href="./shopforadmin.php"><i class="fas fa-shopping-bag fa-lg"><p class="shop">shop</p></i></a></span>
            <span class="micons"><a href="./adminpanel.php"><i class="fas fa-users-cog"><p class="shop">Dashboard</p></i></a></span>
            <span class="micons"><a href="./adminlogout.php"><i class="fas fa-sign-out-alt"><p class="account">Logout</p></i></a></span>
            <!-- <span class="micons"><i class="fas fa-search fa-lg"id="searchicon" onclick="enable()"><p class="search">search</p></i></span> -->
          </div>
        </div>
       
      </div>
    </section>
  <!-- End Of Section-2 -->

  <!-- Start of section-3 -->
  <section class="table-section">
      <div class="customer-list">
      <table>
        <h2>Our Customers</h2>
          <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Last Log</th>
              <th class="edit">Edit</th>
              <th class="delete">Delete</th>
          </tr>
          <?php echo $user_list?>
      </table>
      </div>
  </section>
</body>
</html>

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
    $query = "SELECT * FROM adminlist WHERE email = '{$email}'AND id !={$admin_id} LIMIT 1";
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
                                   $query = "UPDATE adminlist SET ";
                                   $query .= "first_name = '{$first_name}', ";
                                   $query .= "last_name = '{$last_name}', ";
                                   $query .= "email = '{$email}'";
                                   $query .= "WHERE id='{$admin_id}' LIMIT 1";
                                   
                                    $result = mysqli_query($connection,$query);
                                    if($result){
                                        //query is successful redirect to adminlist page
                                        header("Location:adminlist.php?user_modified=true");
                                        
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
    <title>Edit Admin Profile</title>
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
          <span class="menu-items-1"><a href="./adminpanel.php">Back to dashboard</a></span>
          <!-- <span class="menu-items-1"><a href="./shop.php">Shop</a></span> -->
          <span class="menu-items-1"id="userregister">Edit Profile</span>
          <span class="menu-items-1"><a href="./logout.php">Sign Out</a></span>
          <!-- <span class="menu-items-1"><i class="fas fa-search"onclick="enable()"></i></span> -->
          <span class="menuAll"><i class="fas fa-bars fa-lg"></i></span>
          <div class="menuIcons">
             <span class="micons micons-1"><a href="./homeforadmin.php"><i class="fas fa-home fa-lg"><p class="home">home</p></i></a></span>
            <span class="micons"><a href="./shopforadmin.php"><i class="fas fa-shopping-bag fa-lg"><p class="shop">shop</p></i></a></span>
            <span class="micons"><a href="./adminpanel.php"><i class="fas fa-users-cog"><p class="shop">Dashboard</p></i></a></span>
            <span class="micons"><a href="./adminlogout.php"><i class="fas fa-sign-out-alt"><p class="account">Logout</p></i></a></span>
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
                    <form action="modifyadmin.php" method="post">
                    <input type="hidden"name="admin_id"value="<?php echo $admin_id;?>">
                        <h3 class="registration">Edit Admin Profile</h3>
                        <?php
                          if(!empty($errors)){
                           display_errors($errors);
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
                                     <input type="text"name="username" >
                                 </p> -->
                                 <p>
                                     <label for="">Email</label>
                                     <input type="text"name="email"<?php echo 'value="'. $email.'"';?>>
                                 </p>
                                 <p>
                                    <span id="change-password"><a href="changepasswordadmin.php?admin_id=<?php echo $admin_id;?>">Change Password</a></span>
                                 </p>
                            </div>
                            <div class="right-part">
                                <!-- <p>
                                    <label for="">Phone Number</label>
                                    <input type="phonenumber"name="phonenumber" >
                                </p>
                                <p>
                                    <label for="">Address</label>
                                    <input type="address"name="address" >
                                </p>
                                <p>
                                    <label for="">Address</label>
                                    <input type="address"name="address">
                                </p> -->
                                <p>
                                    <!-- <label id="password" for="">Password </label> -->
                                   
                                    <!-- <input type="password"name="password"> -->
                                </p>
                               
                            </div>
                        </div>
                        <p>
                        <input type="submit"name="submit" value="Save Change">
                        </p>
                    </form>
                </fieldset>
            </div>
        </div>
    </section>
  <!-- End Of Section 3 -->
</body>
</html>
<?php mysqli_close($connection);?>
<script src="./main.js"></script>
<?php session_start();?>

<?php  require_once('connection.php');  ?>
<?php  require_once('functions.php');  ?>

<?php

if(!isset($_SESSION['admin_id'])){
  header('Location:adminloggin.php');
}

$errors = array();

    $product_name = '';
    $product_category = '';
    // $username = '';
    $quantity = '';
    $price = '';
    $image_url = '';
    $description = '';
    // $address2 = '';

    if(isset($_POST['submit']) && isset($_FILES['image_url'])){
      // echo "<pre>";
      //  print_r($_FILES['image_url']);
      //  echo "</pre>";
       
        //die();

        $image_name= $_FILES['image_url']['name'];
        $image_path= $_FILES['image_url']['full_path'];
        $image_type= $_FILES['image_url']['type'];
        $image_tmp_name= $_FILES['image_url']['tmp_name'];
        $image_error= $_FILES['image_url']['error'];
        $image_size= $_FILES['image_url']['size'];



        $product_name = $_POST['product_name'];
        $product_category = $_POST['product_category'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $image_url = $_FILES['image_url'];
        $description = $_POST['description'];

        //echo $image_path.$image_name;
        //echo $image_path;
        //$image_path = pathinfo($image_name, PATHINFO_EXTENSION);
        
        //$image_ex_lc = strtolower($image_path);
        
        //$extention = array("jpg","jpeg","png");

        //if(in_array($image_ex_lc,$extention)){
         // $new_image_name = uniqid("IMG",true).'.'.$image_ex_lc;
          
          $image_upload_path = 'images/'.$image_name;
          $new_image_name = move_uploaded_file($image_tmp_name,$image_upload_path);
          //echo "./".$image_upload_path;
          //die();
         
          //insert into databace

          // $query = "INSERT INTO products (";
          // $query .= "product_name, product_category, quantity , price, image_url, description";
          // $query .= ") VALUES (";
          // $query .= "'{$product_name}','{$product_category}','{$quantity}','{$price}',($new_image_name),'{$description}'";
          // $query .= ")";


         
        //}
       
        
        
        //Check required feilds
        $req_feilds = array('product_name','product_category','quantity','price','description');
        foreach($req_feilds as $field){
          if(empty(trim($_POST[$field]))){
            $errors[] = $field.' Is Required';
          }
        }
  
        //Check max lenth of fields
      // $max_length_fields = array('first_name'=>100,'last_name'=>100,'email'=>50,'password'=>50,'phone_number'=>20);
      // foreach($max_length_fields as $field => $max_len){
      //   if(strlen(trim($_POST[$field]))> $max_len){
      //     $errors[] = $field.' Must be less than'.$max_len .' characters.';
      //   }
      // }
      //Check it is a correct email address
      // if(!is_email($_POST['email'])){
      //     $errors[]='Email Address Is Invalid';
      //   }
  
      //check if email address is already exists
      // $product_name = mysqli_real_escape_string($connection, $_POST['product_name']);
      // $query = "SELECT * FROM products WHERE product_name = '{$product_name}'LIMIT 1";
      // $result_set = mysqli_query($connection,$query);
  
      // if($result_set){
      //   if(mysqli_num_rows($result_set)==1){
      //       $errors[] = ' The email address is already exists';
      //   }
      // }
  
      if(empty($errors)){
        //no errors found
            $product_name = mysqli_real_escape_string($connection,$_POST['product_name']);
            $product_category = mysqli_real_escape_string($connection,$_POST['product_category']);
            $quantity = mysqli_real_escape_string($connection,$_POST['quantity']);
            $price = mysqli_real_escape_string($connection,$_POST['price']);
            $description = mysqli_real_escape_string($connection,$_POST['description']);
      //   // $address2 = mysqli_real_escape_string($connection,$_POST['address']);
      //   $password = mysqli_real_escape_string($connection,$_POST['password']);
  
      //   $hashed_password = sha1($password);

      $query = "INSERT INTO products(product_name,product_category,quantity,price,image_url,description) 
                VALUES('$product_name','$product_category','$quantity','$price','$image_name','$description')";
      
      $result = mysqli_query($connection,$query);

      if($result){
        //query is successful redirect to user login page
        header("Location:addnewproduct.php?user_added=true");
    }else{
      $errors[]='Feaild to add the new record';
    }

      } 
       

       
        
      //}
  
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new product</title>
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
                <fieldset id="add-product-form">
                    <form action="addnewproduct.php" method="post" enctype="multipart/form-data">
                        <h3 class="registration">Add New Product Into Databace</h3>
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
                       
                       <div class="add-product">
                         <div class="left-side">
                           <!-- product categories -->
                           <p><label for="">Product Category</label><select name="product_category" id="">
                             <option value="3dprinterandcnc">3D Printer And CNC</option>
                             <option value="electronic_components">Electronic Components</option>
                             <option value="development_boards">Development Boards</option>
                           </select></p>
                           <!-- product name -->
                            <p><label for="">Product Name</label><select name="product_name" id=""<?php echo 'value="'. $product_name.'"';?>>
                              <option value="Couplings">Couplings</option>
                              <option value="Stepper Motors">Stepper Motors</option>
                              <option value="Steel Rods">Steel Rods</option>
                              <option value="Bearings">Bearings</option>
                              <option value="Belts and pully">Belts and pully</option>
                              <option value="Spindles and Accessories">Spindles and Accessories</option>
                              <option value="Heart Bed And Accessories">Heart Bed And Accessories</option>
                              <option value="Driver and controllers">Driver and controllers</option>
                              <option value="Arduino">Arduino</option>
                              <option value="Raspberry Pi">Raspberry Pi</option>
                              <option value="ESP32-SE2-Saola-1">ESP32-SE2-Saola-1</option>
                              <option value="Microbit">Microbit</option>
                              <option value="Display"> Display</option>
                              <option value="Inductors">Inductors</option>
                              <option value="IC">IC</option>
                              <option value="Motors">Motors</option>
                              <option value="Ocsillator Crystals">Ocsillator Crystals</option>
                              <option value="PCBs">PCBs</option>
                              <option value="Relays">Relays</option>
                              <option value="Resistors">Resistors</option>
                              <option value="Sensors & Modules">Sensors & Modules</option>
                              <option value="Soldering Accessories">Soldering Accessories</option>
                              <option value="Switches">Switches</option>
                              <option value="Thyristors">Thyristors</option>
                              <option value="Power Supplies">Power Supplies</option>
                              <option value="Motor Controllers">Motor Controllers</option>
                            </select></p>
            
                           

                           
                           <p><label for="">Product Description</label><br><textarea name="description"<?php echo 'value="'. $description.'"';?> id="" cols="30" rows="5"></textarea></p>
                           <div class="btn-controls">
                              <p id="add"><input id="add-btn"type="submit" name="submit"value="Add To Databace"></p>
                              <!-- <p><input type="submit" name="submit"value="Edit Product"></p>
                              <p><input type="submit" name="submit"value="Delete Product"></p> -->
                           </div>
                          </div>



                         <div class="right-side">
                         <p><label for="">Quantity</label><input type="text"name="quantity"placeholder="Set quantity"<?php echo 'value="'. $quantity.'"';?>></p>
                           <p><label for="">Price</label><input type="text"name="price"placeholder="Set price"<?php echo 'value="'. $price.'"';?>></p>

                          <div class="image-display-console">
                          <label for="">Product Image</label>
                         
                          <div class="display-image"><img id="output_image" width="200px"height="200px" alt=""></div>
                           <p><input class="image-input" style="border-bottom:none;" type="file"id="image_url"name="image_url"onchange="loadfile(event)"></p>
                          </div>


                           <!-- <p id="company-logo">TronicSpace</p> -->
                           <!-- <div class="bottom-side">
                           
                         </div> -->
                         </div>
                       </div>
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
      
  
</body>
</html>
<?php mysqli_close($connection); ?>
<script src="./main.js"></script>
<?php session_start();?>
<?php  require_once('connection.php');  ?>
<?php  require_once('functions.php');  ?>


<?php

if(!isset($_SESSION['admin_id'])){
  header('Location:adminloggin.php');
}


// Getting the list of user
// $query = "SELECT * FROM products WHERE id ={$product_id} LIMIT 1";    
// $products = mysqli_query($connection,$query);
  
// verify_query($products);
//     if(mysqli_num_rows($products)>0){
//       $product = mysqli_fetch_assoc($products);
//         $product_id = $product['id'];
//    }  

// if(!isset($_SESSION['user_id'])){
//   header('Location:adminloggin.php');
// }

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
        $product_id = $_POST['product_id'];
       

        //echo $image_path.$image_name;
        //echo $image_path;
        //$image_path = pathinfo($image_name, PATHINFO_EXTENSION);
        
        //$image_ex_lc = strtolower($image_path);
        
        //$extention = array("jpg","jpeg","png");

        //if(in_array($image_ex_lc,$extention)){
          //$new_image_name = uniqid("IMG",true).'.'.$image_ex_lc;
          
          $image_upload_path = 'images/'.$image_name;
          move_uploaded_file($image_tmp_name,$image_upload_path);
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
        $req_feilds = array('product_id','product_name','product_category','quantity','price','description');
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

      // $query = "UPDATE product SET(product_name,product_category,quantity,price,image_url,description) 
      //           VALUES('$product_name','$product_category','$quantity','$price','$new_image_name','$description')";

      $query = "UPDATE products SET product_name='{$product_name}',product_category ='{$product_category}',quantity='{$quantity}',price='{$price}',description='{$description}',image_url='{$image_name}' WHERE id='{$product_id}' LIMIT 1";
      // $query ="UPDATE products SET ";
      // $query .= "product_name ='{$product_name}',";
      // $query .= "product_category = '{$product_category}',";
      // $query .= "price = '{$price}',";
      // $query .= "description = '{$description}',";
      // $query .= "WHERE id = {$product_id} LIMIT 1";
       
       
      $result = mysqli_query($connection,$query);
      if($result){
        //query is successful redirect to user login page
        header("Location:shopforadmin.php?modify=true");
        
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
    <title>Edit Product Details</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./style.css">
    <script src="./main.js"></script>
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
                    <form action="modifyproduct.php" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="product_id" value="<?php echo $product_id;?>">
                        <h3 class="registration">Edit Product Details</h3>
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
                           <p><label for="">Product Category</label><select name="product_category" id=""value="<?php echo $product_category;?>">
                           <option value="<?php echo $product_category;?>"><?php echo ucfirst($product_category);?></option> 
                            <option value="3dprinterandcnc">3D Printer And CNC</option>
                             <option value="electronic_components">Electronic Components</option>
                             <option value="development_boards">Development Boards</option>
                           </select></p>
                           <!-- product name -->
                           
                            <p><label for="">Product Name</label><select name="product_name" id=""value="">
                            <option value="<?php echo $product_name;?>"><?php echo $product_name;?></option>
                              <option value="Cuopling">Cuopling</option>
                              <option value="stepper Motors">Stepper Motors</option>
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
                            </select></p>
                           

                           
                           <p><label for="">Product Description</label><br><textarea  id="" cols="30" rows="5" name="description"><?php echo  $description;?></textarea></p>
                           <div class="btn-controls">
                              <p id="add"><input id="add-btn"type="submit" name="submit"value="Save Changes"></p>
                              <!-- <p><input type="submit" name="submit"value="Edit Product"></p>
                              <p><input type="submit" name="submit"value="Delete Product"></p> -->
                           </div>
                          </div>
                          
                          

                         <div class="right-side">
                         <p><label for="">Quantity</label><input type="text"name="quantity"placeholder="Set quantity"<?php echo 'value="'. $quantity.'"';?>></p>
                           <p><label for="">Price</label><input type="text"name="price"placeholder="Set price"<?php echo 'value="'. $price.'"';?>></p>

                          <div class="image-display-console">
                          
                          <div class="sec-1">
                              <label for="">Old Product Image</label>
                              <?php echo "<div class=\"product-image\"><img src=\"images/{$result['image_url']}\"></div>"?>
                          </div>
                          <div class="sec-2">
                              <label for="">Choose New Image</label>
                              <div class="display-image"><img id="output_image"style="width:100px;height:100px"></div>
                            <input class="image-input" style="border-bottom:none;" type="file"id="image_url"name="image_url"onchange="loadfile(event)">
                          </div>
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
      
  <script src="./main.js"></script>
</body>
</html>
<?php mysqli_close($connection); ?>
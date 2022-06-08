
<?php
    if(isset($_POST['submit'])){

        // echo "<pre>";
        // print_r($_FILES);
        // echo "</pre>";

        $file_name = $_FILES['image']['name'];
        $file_type = $_FILES['image']['type'];
        $file_size = $_FILES['image']['size'];
        $temp_name = $_FILES['image']['tmp_name'];

        $upload_folder = 'images/';
        $new_path = move_uploaded_file($temp_name, $upload_folder.$file_name);
        //  echo $new_path;
        //  die();

        $image_name = $upload_folder.$file_name;
        
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .form-container{
            width:300px;
            margin: 0 auto;
        }
        form input{
            padding-top:10px;
        }
        #image-btn{
            padding:10px;
            margin-top:5px;
        }
        .image-box{
            /* width:200px;
            height:150px; */
        }

    </style>
</head>
<body>


    
        <div class="form-container">
            <!-- <h3>Image upload</h3> -->
            <form action="testimageupload.php" method="post" enctype="multipart/form-data">
               
                
                <!-- <h4>The New Image</h4> -->
                 <?php
                global $new_path;
                if($new_path){
                   // echo '<h3>This is the uploaded file </h3>';
                    echo '<img src="'.$image_name.'"style="width:100px;height:100px;"></br>';
                }
            ?> 
                <div class="image-box">
                <input type="file"name="image">
                <?php echo " <button id=\"image-btn\" type=\"submit\"name=\"submit\">Upload</button>"?>;
                </div>
                
                
                  
               
                
               
            </form>
            
        </div>

</body>
</html>

<?php  require_once('connection.php');  ?>
<?php

function verify_query($result_set){
        global $connection;

        if(!$result_set){
            die("Databace query faild:".mysqli_error($connection));
        }
}

function check_req_fields($req_fields){
    // Check require fields

    $errors = array();
    foreach($req_fields as $field){
        if(empty(trim($_POST[$field]))){
          $errors[] = $field.' Is Required';
        }
        
      }
      return $errors;
}

//Check max length
function check_max_length($max_length_fields){
    $errors = array();
    foreach($max_length_fields as $field => $max_len){
        if(strlen(trim($_POST[$field]))> $max_len){
          $errors[] = $field.' Must be less than'.$max_len .' characters.';
        }
      }
      return $errors;
}

// Display errors and format division tag
function display_errors($errors){
    echo '<div class="errors">';
    echo 'There were error(s) in your form </br>';
    foreach($errors as $error){
      $error = ucfirst(str_replace("_"," ",$error));
      echo $error .'</br>';
    }
    echo '</div>';
}

//image display


?>
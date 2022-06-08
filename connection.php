<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'userdb';

$connection = mysqli_connect('localhost','root','','userdb');

//checking the connection
if(mysqli_connect_errno()){
    die('Databace Connection Feaild'.mysqli_connect_errno());
}

?>
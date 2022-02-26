<?php 
    //SESSION START
    
    //Create Constants to store Non Repeating Values
    // define('SITEURL', 'http://localhost/GVKProject/');
    // define('LOCALHOST', 'localhost');
    // define('DB_USERNAME', 'root');
    // define('DB_PASSWORD', '');
    // define('DB_NAME', 'new');

    $conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error($conn)); //Database Connection
    $db_select = mysqli_select_db($conn, 'new') or die(mysqli_error($conn)); //Selecting Database
 
    if(!$conn){
        die("COnnection to this database failed due to " . 
        mysqli_connect_error());
    }
    // echo("Success connecting to db");
?>
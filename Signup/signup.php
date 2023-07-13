<?php

session_start();

$host = "localhost";
$user = "root";
$password = '';
$db_name = "portfolio";

$con = new mysqli($host, $user, $password, $db_name);


if ($con->conect_error) {
    die("conection failed: " . $con->conect_error);
}


$sql = "INSERT INTO `credentials`(`Username`, `e-mail`, `password`) VALUES('$_POST[username]','$_POST[email]','$_POST[password]')";



if ($con->query($sql) === TRUE) {
    header('location: http://localhost/Portfolio%20Website/Login/login.html');
} else {
  

    echo "Error: " . $sql . "<br>" . $con->error;
}



$con->close();

?>
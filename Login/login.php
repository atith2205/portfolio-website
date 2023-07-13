<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<script type="text/javascript">

	</script>
</body>

</html>

<?php

session_start();

$host = "localhost";
$user = "root";
$password = '';
$db_name = "portfolio";
$con = mysqli_connect($host, $user, $password, $db_name);

if (mysqli_connect_errno()) {

	die("failed to connect with MYSQL: " . mysqli_connect_errno());
}

$Username = $_POST['Username'];
$password = $_POST['password'];


//to prevent from mysqli injection

$username = stripcslashes($Username);
$password = stripcslashes($password);
$username = mysqli_real_escape_string($con, $username);
$password = mysqli_real_escape_string($con, $password);
$sql = "select *from credentials where Username = '$username' and password = '$password'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if ($count === 1) {
	$sql = "select id from credentials where Username = '$username'";
	$result = mysqli_query($con, $sql);
	$rows1 = mysqli_fetch_assoc($result);
	$_SESSION["id"] = $rows1['id'];
	$_SESSION["Username"] = $username;
	// echo "<div id='demo'> Success</div>";
	echo '<script>alert("Welcome back !")</script>';

	header('location: https://localhost/Portfolio Website/Portfolio.php');
} else {

	echo "<div id='demo'>Failure</div>";
	header('location: https://localhost/Portfolio Website/Login/login.html');
}

?>


<script type="text/JavaScript">


	if(document.getElementById("demo").innerHTML === "Success"){
    alert("Successfully logged in");
}

else{
	echo '<script>alert("Sorry, invalid credentials.")</script>';

// alert("Failed");
}

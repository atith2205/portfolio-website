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


$Username = $_SESSION['Username'];
$sql = "SELECT * FROM `link` WHERE Username = ' $Username '";

$result = mysqli_query($con, $sql);
$rows1 = mysqli_fetch_assoc($result);


$result = mysqli_query(
    $con,
    $sql
);

$flag = true;
echo mysqli_num_rows($result);

if (mysqli_num_rows($result) === 1) {
    print("yes");
    header("http://localhost/Portfolio%20Website/Portfolio.php");
} else {
    $flag = false;
    echo '<script>alert("Please select your resume from the following")</script>';
}



// $result = mysqli_query($con, $sql);
// $rows1 = mysqli_fetch_assoc($result);

// $flag = true;
// // echo $rows1['Resume'];
// echo mysqli_num_rows($result);

// if (mysqli_num_rows($result)) {

//     print("yes");
//     // header("http://localhost/Portfolio%20Website/Portfolio.php");
// } else {
//     $flag = false;
//     print("fail");
//     // echo '<script>alert("Please fill out the information required")</script>';
// }
?>

<embed src="<?php echo "Resume_pdfs/" . $rows1['Resume']; ?>" height="900" width="900" title="Resume"> </embed>
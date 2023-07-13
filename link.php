
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


$result = mysqli_query(
    $con,
    "SELECT * FROM `link` WHERE Username = ' $Username '"
);


if (isset($_POST["submit_resume"])) {

    $target_dir = "Resume_pdfs/";

    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $Resume = $_FILES["fileToUpload"]["name"];
    $upd = "SELECT * FROM `link` WHERE Username = '$Username'";
    $result = mysqli_query($con, $upd);
    $rows1 = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
    if ($count === 1) {
        $resume = "UPDATE `link` SET `Resume` = '$Resume' WHERE Username = '$Username';";
        mysqli_query($con, $resume);
        echo "success";
    } else {
        $sql = "INSERT INTO `link`(`Username`, `Resume`) VALUES('$Username','$Resume')";

        if ($con->query($sql) === TRUE) {
            echo  "uploaded";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }

    $check = filesize($_FILES["fileToUpload"]["tmp_name"]);

    if ($check !== false) {
        echo '<script>alert("Your PDF has been uploaded.")</script>';
        echo "File is a PDF " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not a PDF.";
        $sq = $_POST['fileToUpload'];
        echo $sq;

        $uploadOk = 0;
    }

    sleep(1);
    echo '<a href ="index.php"> Home</a>';

    // Check if file already exists
    if (file_exists($target_file)) {
        // echo '<script>alert("Your image already exists .")</script>';

        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo '<script>alert("Your pdf is too large .")</script>';

        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }


    // Allow certain file formats
    if (
        $imageFileType != "pdf"
    ) {

        // echo '<script>alert("Sorry, only PDF files are allowed")</script>';

        // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo '<script>alert("Your PDF was not uploaded.")</script>';

        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    // header("Location: http://localhost/Portfolio%20Website/index.php");
}


if (isset($_POST["submit_links"])) {
    $upd = "SELECT * FROM `link` WHERE Username ='$Username'";
    $result = mysqli_query($con, $upd);
    $rows2 = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
    $github = $_POST['github'];
    $linkedin = $_POST['linkedin'];
    echo $count;
    if ($github !== "") {

        if ($count === 1) {

            $Github = "UPDATE `link` SET `github` = '$github' WHERE Username = '$Username';";
            mysqli_query($con, $Github);
            echo "success";
        } else {

            $sql = "INSERT INTO `link`(`Username`, `github`) VALUES('$Username','$github')";

            if ($con->query($sql) === TRUE) {
                echo "uploaded";
            } else {
                // echo "Error: " . $sql . "<br>" . $con->error;
            }
        }
    }
    if ($linkedin !== "") {

        if ($count === 1) {

            $Linkedin = "UPDATE `link` SET `linkedin` = '$linkedin' WHERE Username = '$Username';";
            mysqli_query($con, $Linkedin);
            echo "success";
        } else {

            $sql = "INSERT INTO `link`(`Username`, `linkedin`) VALUES('$Username','$linkedin')";

            if ($con->query($sql) === TRUE) {
                echo "uploaded";
            } else {
                // echo "Error: " . $sql . "<br>" . $con->error;
            }
        }
    }



    sleep(1);
    echo '<a href="index.php"> Home</a>';
    // header("Location: http://localhost/Portfolio%20Website/index.php");
}

if (isset($_POST["submit_projects"])) {
    $upd = "SELECT * FROM `link` WHERE Username ='$Username'";
    $result = mysqli_query($con, $upd);
    $rows2 = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);

    $Project_1 = $_POST['Project-1'];
    $Project_2 = $_POST['Project-2'];
    $Project_3 = $_POST['Project-3'];

    echo $count;
    if ($Project_1 !== "") {

        if ($count === 1) {

            $Github = "UPDATE `link` SET `Project-1` = '$Project_1' WHERE Username = '$Username';";
            mysqli_query($con, $Github);
            echo "success";
        } else {

            $sql = "INSERT INTO `link`(`Username`, `Project-1`) VALUES('$Username','$Project_1')";

            if ($con->query($sql) === TRUE) {
                echo "uploaded";
            } else {
                // echo "Error: " . $sql . "<br>" . $con->error;
            }
        }
    }
    if ($Project_2 !== "") {

        if ($count === 1) {

            $Github = "UPDATE `link` SET `Project-2` = '$Project_2' WHERE Username = '$Username';";
            mysqli_query($con, $Github);
            echo "success";
        } else {

            $sql = "INSERT INTO `link`(`Username`, `Project-2`) VALUES('$Username','$Project_2')";

            if ($con->query($sql) === TRUE) {
                echo "uploaded";
            } else {
                // echo "Error: " . $sql . "<br>" . $con->error;
            }
        }
    }
    if ($Project_3 !== "") {

        if ($count === 1) {

            $Github = "UPDATE `link` SET `Project-3` = '$Project_3' WHERE Username = '$Username';";
            mysqli_query($con, $Github);
            echo "success";
        } else {

            $sql = "INSERT INTO `link`(`Username`, `Project-3`) VALUES('$Username','$Project_3')";

            if ($con->query($sql) === TRUE) {
                echo "uploaded";
            } else {
                // echo "Error: " . $sql . "<br>" . $con->error;
            }
        }
    }



    sleep(1);
    echo '<a href="index.php"> Home</a>';
    // header("Location: http://localhost/Portfolio%20Website/index.php");
}






?>
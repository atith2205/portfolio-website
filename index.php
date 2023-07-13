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
$id = $_SESSION['id'];
$var = "SELECT * FROM `profile` WHERE id = ' $id '";
$query1 = mysqli_query($con, $var);
$rows1 = mysqli_fetch_assoc($query1);
$r = mysqli_num_rows($query1);

// $sql = "select *from credentials where Username = '$username' and password = '$password'";
// $result = mysqli_query($con, $sql);
// $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
// $count = mysqli_num_rows($result);

$li = "SELECT * FROM `link` WHERE Username = '$Username'";
$query2 = mysqli_query($con, $li);
$rows2 = mysqli_fetch_assoc($query2);
$r2 = mysqli_num_rows($query2);

if ($r == 0) {
    echo "Error";
} else {
    //  echo "Success";`
}


if (isset($_POST['logout'])) {
    //I don't think there is any reason to check if username is set. If you are logging out, just destroy.
    session_destroy();
    //Also unset the session username since session_destroy() does not affect existing globals.
    unset($_SESSION['Username']);
    unset($_SESSION['id']);
    header("location: http://localhost/Portfolio%20Website/Login/login.html");
}
echo $rows2['Project-1'] . "hi";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/Footer.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">

    <!-- =====BOX ICONS===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <title>Portfolio </title>
</head>

<body>
    <!--===== HEADER =====-->
    <header class="l-header">
        <nav class="nav bd-grid">
            <div>
                <a href="index.php" class="nav__logo"><?php echo $rows1['firstName'] . ' ' .
                                                            $rows1['lastName']; ?></a>
            </div>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item"><a href="#home" class="nav__link active">Home</a></li>
                    <li class="nav__item"><a href="#about" class="nav__link">About</a></li>
                    <li class="nav__item"><a href="#work" class="nav__link">Work</a></li>
                    <li class="nav__item"><a href="#contact" class="nav__link">Contact</a></li>
                    <li class="nav__item"><a href="./Portfolio.php" class="nav__link">My Profile</a></li>
                    <form action="index.php" method="POST">
                        <li class="nav__item">
                            <a href="./Login/login.html" class="nav__link" name="logout">Logout</a>
                        </li>
                    </form>

                </ul>
            </div>

            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-menu'></i>
            </div>
        </nav>
    </header>

    <main class="l-main">
        <!--===== HOME =====-->
        <section class="home bd-grid" id="home">
            <div class="home__data">
                <h1 class="home__title">Hi,<br>I am <span class="home__title-color"><?php echo $rows1['firstName'];
                                                                                    $rows1['lastName'];  ?> .</span><br> A <?php echo $rows1['Post'];  ?> at <?php echo $rows1['University'];  ?> . </h1>

                <?php if ($r2 === 1) {
                    echo "<a href='Resume_pdfs/" . $rows2['Resume'] . "' class='button'>My Resume </a> ";
                } else {
                    echo "<button onClick='myResume()' class='button'>My Resume</button>  ";
                    echo
                    '<script> function myResume(){
                        alert("Please upload your resume.")
                    }
                    </script>';
                }

                ?>

            </div>

            <div class="home__social">
                <?php if ($rows2['github'] != "") {
                    echo "    <a href='" . $rows2['github'] . "' class='home__social-icon'><i class='bx bxl-github'></i></a>";
                }
                if ($rows2['linkedin'] != "") {
                    echo "    <a href='" . $rows2['linkedin'] . "' class='home__social-icon'><i class='bx bxl-linkedin'></i></a>";
                }


                ?>
            </div>

            <div class="home__img">
                <form action="upload.php" method="POST" enctype="multipart/form-data">
                    <img src="<?php echo "Uploaded_images/" . $rows1['img']; ?>" alt="">
                    Select image to upload:
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="submit" value="Upload Image" name="submit">
                </form>

            </div>
        </section>

        <!--===== ABOUT =====-->
        <section class="about section " id="about">
            <h2 class="section-title">About</h2>

            <div class="about__container bd-grid">
                <div class="about__img">
                    <img src="<?php echo "Uploaded_images/" . $rows1['img']; ?>" alt="">
                </div>

                <div>
                    <h2 class="about__subtitle">I am <?php echo $rows1['firstName']; ?></h2>
                    <p class="about__text"><?php echo $rows1['aboutMe']; ?></p>
                </div>
            </div>
        </section>

        <!-- ===== SKILLS =====
        <section class="skills section" id="skills">
            <h2 class="section-title">Skills</h2>

            <div class="skills__container bd-grid">
                <div>
                    <h2 class="skills__subtitle">Profesional Skills</h2>
                    <p class="skills__text">Skills i like :</p>
                    <div class="skills__data">
                        <div class="skills__names">
                            <i class='bx bxl-html5 skills__icon'></i>
                            <span class="skills__name">HTML5</span>
                        </div>
                        <div class="skills__bar skills__html">

                        </div>
                        <div>
                            <span class="skills__percentage">95%</span>
                        </div>
                    </div>
                    <div class="skills__data">
                        <div class="skills__names">
                            <i class='bx bxl-css3 skills__icon'></i>
                            <span class="skills__name">CSS3</span>
                        </div>
                        <div class="skills__bar skills__css">

                        </div>
                        <div>
                            <span class="skills__percentage">85%</span>
                        </div>
                    </div>
                    <div class="skills__data">
                        <div class="skills__names">
                            <i class='bx bxl-javascript skills__icon'></i>
                            <span class="skills__name">JAVASCRIPT</span>
                        </div>
                        <div class="skills__bar skills__js">

                        </div>
                        <div>
                            <span class="skills__percentage">65%</span>
                        </div>
                    </div>
                    <div class="skills__data">
                        <div class="skills__names">
                            <i class='bx bxs-paint skills__icon'></i>
                            <span class="skills__name">UX/UI</span>
                        </div>
                        <div class="skills__bar skills__ux">

                        </div>
                        <div>
                            <span class="skills__percentage">85%</span>
                        </div>
                    </div>
                </div>

                <div>
                    <img src="assets/img/work3.jpg" alt="" class="skills__img">
                </div>
            </div>
        </section> -->

        <!--===== WORK =====-->
        <section class="work section" id="work">
            <h2 class="section-title">Work</h2>


            <div class="projects">
                <?php if ($rows2['Project-1'] != "") {
                    echo "   <a class='button' target='_blank' href='" . $rows2['Project-1'] . "'>Link to Project-1</a><br> <br><br>";
                }


                if ($rows2['Project-2'] != "") {
                    echo "   <a   class='button' target='_blank'  href='" . $rows2['Project-2'] . "'>Link to Project-2 </a><br><br><br> ";
                }
                if ($rows2['Project-3'] != "") {
                    echo "   <a class='button' target='_blank' href='" . $rows2['Project-3'] . "'>Link to Project-3</a><br>";
                }


                ?>




            </div>
        </section>

        <!--===== CONTACT =====-->
        <section class="contact section" id="contact">
            <h2 class="section-title">Contact</h2>

            <div class="contact__container bd-grid">
                <form method="post">

                    <textarea name="" id="" cols="100" rows="10" class="contact__input" placeholder="Reach out to me.."></textarea>

                    <input type="button" value="Send Email" onclick="sendEmail()" />
                </form>

            </div>
        </section>
    </main>
    <!-- ===== FOOTER ===== -->



    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4>company</h4>
                    <ul>
                        <li><a href="aboutUs.html">about us</a></li>
                        <li><a href="#">our services</a></li>
                        <li><a href="#">privacy policy</a></li>
                        <li><a href="#">affiliate program</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>get help</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>

                        <!-- <li><a href="#">shipping</a></li> -->
                        <!-- <li><a href="#">returns</a></li> -->
                        <!-- <li><a href="#">order status</a></li> -->
                        <!-- <li><a href="#">payment options</a></li> -->
                    </ul>
                </div>
                <!-- <div class="footer-col">
                            <h4>online shop</h4>
                            <ul>
                                <li><a href="#">watch</a></li>
                                <li><a href="#">bag</a></li>
                                <li><a href="#">shoes</a></li>
                                <li><a href="#">dress</a></li>
                            </ul>
                        </div> -->
                <div class="footer-col">
                    <h4>follow us</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>




    <!--===== SCROLL REVEAL =====-->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!--===== MAIN JS =====-->
    <script src="assets/js/main.js"></script>
    <script src="./Portfolio.php"></script>
    <script src="./upload.php"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <script src="./index.js"></script>
    <script src="./link.php"></script>
    <script src="./Resume.php"></script>
</body>

</html>
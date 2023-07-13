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


  $id = $_SESSION['id'];

  $result = mysqli_query(
    $con,
    "SELECT * FROM `profile` WHERE id = ' $id '"
  );

  $flag = true;

  if (mysqli_num_rows($result)) {
    // print("yes");
    header("http://localhost/Portfolio%20Website/Portfolio.php");
  } else {
    $flag = false;
    echo '<script>alert("Please fill out the information required")</script>';
  }

  if (isset($_POST['save_changes'])) {

    $id = $_SESSION['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $aboutMe = $_POST['aboutMe'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $postalCode = $_POST['postalCode'];
    $University = $_POST['University'];
    $Post = $_POST['Post'];
    $img = $_POST['img'];


    $sql = "INSERT INTO `profile` (`id`, `firstName`, `lastName`, `aboutMe`, `city`, `country`, postalCode, `address`, `University`, `Post`) VALUES (' $id '  ,'  $firstName  ','  $lastName  ','  $aboutMe  ','  $city  ','  $country  ','  $postalCode  ',' $address  ', '$University', '$Post');";
    $upd = "UPDATE `profile` SET firstName = '$firstName', lastName = '$lastName', aboutMe = '$aboutMe', city = '$city', country = '$country', postalCode = '$postalCode', address = '$address', University = '$University', Post = '$Post' WHERE id = '$id' ;";
    print($upd);

    if ($flag === true) {

      if ($con->query($upd) === TRUE) {
        echo "SUCCESS";
        header('location: http://localhost/Portfolio%20Website/index.php');
      } else {
        // echo "Error: " . $upd . "<br>" . $con->error;
      }
    } else {

      if ($con->query($sql) === TRUE) {
        echo "SUCCESS";
        header('location: http://localhost/Portfolio%20Website/index.php');
      } else {
        echo "Error: " . $sql . "<br>" . $con->error;
      }
    }
  }




  $var = "SELECT * FROM `profile` WHERE id = ' $id'";
  $query1 = mysqli_query($con, $var);
  $rows1 = mysqli_fetch_assoc($query1);
  $r = mysqli_num_rows($query1);

  // if ($r == 0) {
  //   echo "Error";
  // } else {
  //   echo "Success";
  // }



  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>


    </link>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <link rel="stylesheet" href="./Profile.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  </head>

  <body>

    <div class="main-content">
      <!-- Top navbar -->
      <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
        <div class="container-fluid">
          <!-- Brand -->
          <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index.php" target="_blank">Home</a>
          <!-- Form -->
          <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
            <div class="form-group mb-0">

            </div>
          </form>
          <!-- User -->
          <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img src="<?php echo "Uploaded_images/" . $rows1['img']; ?>" ` alt="">
                  </span>
                  <div class="media-body ml-2 d-none d-lg-block">
                    <span class="mb-0 text-sm font-weight-bold"><?php echo $rows1['firstName']; ?></span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <a href="#" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>My profile</span>
                </a>
                <a href="#" class="dropdown-item">
                  <i class="ni ni-settings-gear-65"></i>
                  <span>Settings</span>
                </a>
                <a href="#" class="dropdown-item">
                  <i class="ni ni-calendar-grid-58"></i>
                  <span>Activity</span>
                </a>
                <a href="#" class="dropdown-item">
                  <i class="ni ni-support-16"></i>
                  <span>Support</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
      <!-- Header -->
      <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="
          min-height: 600px;
          /* background-image: url(https://raw.githack.com/creativetimofficial/argon-dashboard/master/assets/img/theme/profile-cover.jpg); */
          background-size: cover;
          background-position: center top;
        ">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
          <div class="row">
            <div class="col-lg-7 col-md-10">
              <h1 class="display-2 text-white">Hello, <?php echo $rows1['firstName']; ?></h1>
              <p class="text-white mt-0 mb-5">
                This is your profile page. You can see the progress you've made
                with your work and manage your projects or assigned tasks.
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- Page content -->
      <div class="container-fluid mt--7">
        <div class="row">
          <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
            <div class="card card-profile shadow">
              <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                  <div class="card-profile-image">
                    <a href="#">
                      <img src="<?php echo "Uploaded_images/" . $rows1['img']; ?>" alt="">
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              </div>
              <div class="card-body pt-0 pt-md-4">
                <div class="row">
                  <div class="col">
                    <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <h3><?php echo $rows1['firstName'] . ' ' .
                        $rows1['lastName']; ?></h3>
                  <div class="h5 font-weight-300">
                    <i class="ni location_pin mr-2"></i><?php echo $rows1['city']; ?> ,<?php echo $rows1['country']; ?>
                  </div>
                  <div class="h5 mt-4">
                    <i class="ni business_briefcase-24 mr-2"></i><?php echo $rows1['Post']; ?>
                  </div>
                  <div style="color:black">
                    <i class="ni education_hat mr-2"></i><?php echo $rows1['University']; ?>
                  </div>
                  <hr class="my-4" />
                  <p style="color:black;">
                    <?php echo $rows1['aboutMe']; ?>
                  </p>

                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-8 order-xl-1">
            <div class="card bg-secondary shadow">
              <div class="card-header bg-white border-0">
                <div class="row align-items-center">
                  <div class="col-8">
                    <h3 class="mb-0">My Account</h3>
                  </div>
                  <hr class="my-4" />
                  <div class="col-4 text-right">
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form action="Portfolio.php" method="POST">
                  <h6 class="heading-small text-muted mb-4" style="font-weight: bolder;">User Information :</h6>
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group focused">
                          <!-- <label class="form-control-label" placeholder="Username"
                            >Username</label
                          >
                          <input
                            type="text"
                            id="input-username"
                            class="form-control form-control-alternative"
                            placeholder="Username"
                          /> -->
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <!-- <label class="form-control-label" for="input-email"
                            >Email address</label
                          >
                          <input
                            type="email"
                            id="input-email"
                            class="form-control form-control-alternative"
                            placeholder="jesse@example.com"
                          /> -->
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group focused">
                          <label class="form-control-label" for="input-first-name">First name</label>
                          <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="First name" name="firstName" required />
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group focused">
                          <label class="form-control-label" for="input-last-name">Last name</label>
                          <input type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="Last name" name="lastName" required />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group focused">
                          <label class="form-control-label" for="input-first-name">Post</label>
                          <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="Post" name="Post" required />
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group focused">
                          <label class="form-control-label" for="input-last-name">University</label>
                          <input type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="University" name="University" required />
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr class="my-4" />
                  <!-- Address -->
                  <h6 class="heading-small text-muted mb-4">
                    Contact information
                  </h6>
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group focused">
                          <label class="form-control-label" for="input-address">Address</label>
                          <input id="input-address" class="form-control form-control-alternative" placeholder="Home Address" type="text" name="address" required />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group focused">
                          <label class="form-control-label" for="input-city">City</label>
                          <input type="text" id="input-city" class="form-control form-control-alternative" placeholder="City" name="city" required />
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group focused">
                          <label class="form-control-label" for="input-country">Country</label>
                          <input type="text" id="input-country" class="form-control form-control-alternative" placeholder="Country" name="country" required />
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label" for="input-country">Postal code</label>
                          <input type="number" id="input-postal-code" class="form-control form-control-alternative" placeholder="Postal code" name="postalCode" required />
                        </div>
                      </div>

                    </div>
                  </div>
                  <hr class="my-4" />
                  <!-- Description -->
                  <h6 class="heading-small text-muted mb-4">About me</h6>
                  <div class="pl-lg-4">
                    <div class="form-group focused">
                      <label>About Me</label>
                      <textarea rows="4" class="form-control form-control-alternative" placeholder="A few words about you ..." name="aboutMe" required> </textarea>
                    </div>
                  </div>
                  <input type="submit" value="Save Changes" name="save_changes" />
                </form>
                <hr class="my-4" />

                <!-- <div class="pl-lg-4"> -->
                <div class="form-group focused">
                  <label style="color:black">My Projects : </label>
                  <br>
                  <form class="project" action="link.php" method="POST">

                    <div style="color:black">Project 1: &nbsp;
                      <input type="url" id="Project-1" name="Project-1" />
                    </div>
                    <br>
                    <div style="color:black">Project 2: &nbsp;
                      <input type="url" id="Project-2" name="Project-2" />
                    </div>
                    <br>
                    <div style="color:black">Project 3: &nbsp;
                      <input type="url" id="Project-3" name="Project-3" />
                    </div>
                    <br>
                    <input type="submit" value="Submit" name="submit_projects" />
                  </form>


                </div>

                <hr class="my-4" />

                <!-- <div class="pl-lg-4"> -->

                <div class="form-group focused">
                  <label style="color:black">My Links : </label>
                  <form class="links" action="link.php" method="POST">


                    <div style="color:black">Github &nbsp;
                      <input type="url" id="Project-1" name="github">
                    </div>
                    <br>
                    <div style="color:black">linkedIn &nbsp;
                      <input type="url" id="Project-2" name="linkedin">
                    </div>


                    <input type="submit" value="Submit" name="submit_links" />
                  </form>

                </div>


                <hr class="my-4" />
                <div style="color:black">Please upload your resume(Only PDF) :</div>
                <br>
                <form action="link.php" method="POST" enctype="multipart/form-data">
                  <input type="file" name="fileToUpload" style="color: black;" value="fileupload" id="fileToUpload">

                  <input type="submit" value="submit" name="submit_resume">

                </form>
                <hr class=" my-4" />


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6 m-auto text-center">
          <div class="copyright">
          </div>
        </div>
      </div>
    </footer>
    <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>

  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="./Portfolio.js"></script>
  <script src="./upload.php"> </script>
  <script src="./link.php"> </script>
  <script src="./Resume.php"></script>
  <script src="./Portfolio.php"></script>

  </html>
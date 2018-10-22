<?php
session_start();

require 'db_connection.php';
require 'utilities.php';
connect_to_db();

$uname = $_SESSION['user_name'];
$id = $_SESSION["user_id"];
$email = $_SESSION["email"];
$fname = $_SESSION["fname"];
$lname = $_SESSION["lname"];

    if ($conn) {
        if (isset($_POST['Update1'])) {
            $firstname = $_POST['fname'];
            $sql = "UPDATE users SET firstName ='$firstname' WHERE id = $id";
            // Prepare statement
            $stmt = $conn->prepare($sql);
            // execute the query
            $stmt->execute();
            // echo a message to say the UPDATE succeeded
            echo '<script language="javascript">';
            echo 'alert("You have changed your First Name")';
            echo '</script>';
            $_SESSION['fname'] = $firstname;
            $_SESSION["user_name"] = $firstname . " " . $lname;
        }

        if (isset($_POST['Update2'])) {
            $lastname = $_POST['lname'];
            $sql = "UPDATE users SET lastName ='$lastname' WHERE id = $id";
            // Prepare statement
            $stmt = $conn->prepare($sql);
            // execute the query
            $stmt->execute();
            // echo a message to say the UPDATE succeeded
            echo '<script language="javascript">';
            echo 'alert("You have changed your Last Name")';
            echo '</script>';
            $_SESSION['lname'] = $lastname;
            $_SESSION["user_name"] = $fname . " " . $lastname;
        }

        if (isset($_POST['Update3'])) {
            $Email = $_POST['email'];
            $sql = "UPDATE users SET email ='$Email' WHERE id = $id";
            // Prepare statement
            $stmt = $conn->prepare($sql);
            // execute the query
            $stmt->execute();
            // echo a message to say the UPDATE succeeded
            echo '<script language="javascript">';
            echo 'alert("You have Updated your Email")';
            echo '</script>';
            $_SESSION["email"] = $Email;
        }

        if (isset($_POST['Change'])) {
            $ppassword = $_POST['ppassword'];

            $hash =password_hash($ppassword, PASSWORD_DEFAULT);

            $sql = "UPDATE users SET password ='$hash' WHERE id = $id";
            // Prepare statement
            $stmt = $conn->prepare($sql);
            // execute the query
            $stmt->execute();
            // echo a message to say the UPDATE succeeded
            echo '<script language="javascript">';
            echo 'alert("You have changed your Password")';
            echo '</script>';
        }
    }


 ?>


<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard Settings</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link href="css/normalize.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap_customized.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    <script src="js/app.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/dashboard.css">
<link rel="stylesheet" type="text/css" href="css/dashsettings.css">
</head>
<body>
   <div id="wrapper">
  <!-- Sidebar -->
        <div id="sidebar-wrapper">
          <ul class="nav-sidebar">
              <li class="sidebar-inner">
                 <a href="index.php">
                      <b>Prep Me</b>
                  </a>
              </li>
              <li>
                  <a href="dashboard.php">Dashboard</a>
              </li>
              <li>
                  <a href="quiz-gateway.php">Take a Quiz</a>
              </li>
              <li>
                  <a href="quiz-record.php">Quiz Score</a>
              </li>
              <li>
                  <a href="groups.php">Groups</a>
              </li>
              <li>
                  <a href="populateTopicNames.php">Topics</a>
              </li>
              <li>
                  <a href="dashsettings.php">Settings</a>
              </li>
              <li>
                  <a href="logout.php">Logout</a>
              </li>
          </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="content-wrapper">
          <div id="men-toggle">
             <div class="burger"></div>
             <div class="burger"></div>
             <div class="burger"></div>
          </div>
            <div class="container-fluid">
                        <!-- <a href="#menu-toggle" class="btn btn-default" id="men-toggle">Toggle Menu</a> -->
                <div class="row">
                    <div class="col-lg-12">
                         <!-- <h2>Welcom, -->
                         	<?php
//     session_start();
// if (!(isset($_SESSION['fname']) == "Admin")) {
// header ("Location: dashboard.php");
// }
// elseif (!(isset($_SESSION['fname']) && $_SESSION['fname'] != '')) {
// header ("Location: login.php");
// }
// else{
//     echo $_SESSION['fname'];
// }
//?></h2>
                    </div>
                 <script>
    $("#men-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
                </div>
                <div class="row">
<form action="dashsettings.php" method="post" class="formstyle">
  <h2>Update your first name</h2>
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="<?php echo $fname; ?>" name="fname">
  </div>
  <button type="submit" class="btn btn-outline-dark col-12" name="Update1">Update</button>
</form>
</div>

<div class="row">
<form action="dashsettings.php" method="post" class="formstyle">
  <h2>Update your last name</h2>
<div class="input-container">
<i class="fa fa-user-o icon"></i>
    <input class="input-field" type="text" placeholder="<?php echo $lname; ?>" name="lname">
  </div>
  <button type="submit" class="btn btn-outline-dark col-12" name="Update2">Update</button>
</form>
</div>

<div class="row">
<form action="dashsettings.php" method="post" class="formstyle">
  <h2>Update your email</h2>
  <div class="input-container">
    <i class="fa fa-envelope icon"></i>
    <input class="input-field" type="email" placeholder="<?php echo $email; ?>" name="email">
  </div>
    <button type="submit" class="btn btn-outline-dark col-12" name="Update3">Update</button>
</form>
</div>

<div class="row">
<form action="dashsettings.php" method="post" class="formstyle">
	<h2>Change password</h2>
  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="Enter 8 digits Password" name="ppassword">
  </div>
  <button type="submit" class="btn btn-outline-dark col-12" name="Change">Change</button>
</form>
    </div>
</div>
</div>
</div>
    <!-- /#wrapper -->
    </body>
</html>

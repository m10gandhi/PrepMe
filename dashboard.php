<?php
session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
    <link href="css/normalize.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap_customized.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    <script src="js/app.js"></script>
  <link rel="stylesheet" type="text/css" href="css/dashboard.css">
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
                         <h1 class="ml-4">
                           Welcome , <?php if (isset($_SESSION['user_id'])) {
     echo $_SESSION['user_name'];
 } ?>
                         </h1>
    <h2>
      <?php
// if (!(isset($_SESSION['fname']) == "Admin")) {
//      header("Location: dashboard.php");
//  } elseif (!(isset($_SESSION['fname']) && $_SESSION['fname'] != '')) {
//      header("Location: login.php");
//  } else {
//      echo $_SESSION['fname'];
//  }
    ?></h2>

                    </div>

                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
     <!-- Menu Toggle Script -->

     <script>
     $("#men-toggle").click(function(e) {
         e.preventDefault();
         $("#wrapper").toggleClass("toggled");
     });
     </script>
    </body>
</html>

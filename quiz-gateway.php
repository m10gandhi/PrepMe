<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz</title>
  <link href="css/normalize.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" href="css/quiz.css">
  <link rel="stylesheet" type="text/css" href="css/responsive.css">
  <link rel="stylesheet" type="text/css" href="css/dashboard.css">
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</head>
<body>
  <?php
    // $conn = mysqli_connect('db.cs.dal.ca', 'vala', 'B00785077', 'vala');
    // $conn = mysqli_connect('localhost', 'root', '', 'assignent3');
    $servername = "cloud-a3.cnuacuuti7fl.us-east-2.rds.amazonaws.com";
    $username = "vamshi";
    $password = "599-5Me-SSV-7SU";
    $dbname = "prepMe";

    // $conn = mysqli_connect('db.cs.dal.ca', 'vala', 'B00785077', 'vala');
    // $conn = mysqli_connect('localhost', 'root', '', 'assignent3');
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $sql = "SELECT * FROM category";
    $records = mysqli_query($conn, $sql);
  ?>
  <!-- 		<nav class="navbar sticky-top navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Go Home</a>
  </nav> -->

  <!-- <div class="topnav sticky-top" id="myTopnav">
      <a href="index.php" class="active">Home</a>
      <a href="populateTopicNames.php">Topics</a>
      <a href="groups.php">Groups</a>
      <a href="#contact">Contact</a>
      <a href="#about">About</a>
      <a href="javascript:void(0);" class="icon" onclick="navigationMenu()">
          <i class="fa fa-bars"></i>
      </a>
      <div class="topnav-right">
          <a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>
          <a href="register.html"><span class="glyphicon glyphicon-user"></span> Sign up</a>
      </div>
  </div> -->

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
                     <br><br>
                        <!-- <h1 class="ml-4">
                          Welcome , -->
                           <?php
                          // if (isset($_SESSION['user_id'])) {
                          //   echo $_SESSION['user_name'];
                          // }
                          ?>
                        <!-- </h1> -->
                        <center>
                          <div class="container">
                            <form method="post" action="build-quiz-backend.php">
                              <div class="form-group">
                                <label for="category">Select Category: (Please Select Java as other Categories does not have any stored data)</label> <br><br>
                                <select class="form-control" name="category" id="category">
                                  <?php
                                    while ($category = mysqli_fetch_assoc($records)) {
                                        echo "<option>".$category['cat_name']."</option>";
                                    }
                                    mysqli_close($conn);
                                  ?>
                                </select>
                                <br><br>
                                <input type="submit" class="btn btn-primary" name="start_quiz" value="Start Quiz" />
                              </div>
                            </form>
                          </div>
                        </center>
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
  <script>
  $("#men-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
  });
  </script>
  <script src="js/app.js"></script>
</body>
</html>

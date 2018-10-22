<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/quiz.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</head>

<body>
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

  <?php
    $count = $_SESSION["count"];
    $questionid = $_SESSION["questionid"];
    $userAnswers = $_SESSION["userAnswers"];

    // $conn = mysqli_connect('db.cs.dal.ca', 'vala', 'B00785077', 'vala');
    // $conn = mysqli_connect('localhost', 'root', '', 'assignent3');
    $servername = "cloud-a3.cnuacuuti7fl.us-east-2.rds.amazonaws.com";
    $username = "vamshi";
    $password = "599-5Me-SSV-7SU";
    $dbname = "prepMe";

    // $conn = mysqli_connect('db.cs.dal.ca', 'vala', 'B00785077', 'vala');
    // $conn = mysqli_connect('localhost', 'root', '', 'assignent3');
    $conn = mysqli_connect($servername, $username, $password, $dbname);
  ?>
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
                   <a href="quiz-record.php">Quiz Score</a>
               </li>
               <li>
                   <a href="groups.php">Groups</a>
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
                     <form  method="post" action="finish-quiz-backend.php">
                       <div class="container">
                         <div class="jumbotron">
                           <?php
                             if ($count >= 7) {
                                 echo "<h1 style='color: green;'>Excellent Performance: ".($count * 10)."/100</h1>";
                             } elseif (5 <= $count && $count < 7) {
                                 echo "<h1 style='color: DodgerBlue;'>Average Performance: ".($count * 10)."/100</h1>";
                             } else {
                                 echo "<h1 style='color: red;'>Better Luck Next Time: ".($count * 10)."/100</h1>";
                             }
                             $_SESSION["score"] = $count;
                           ?>
                           <br>
                           <center>
                             <h4>Quiz Result</h4>
                             <table class="table table-hover">
                               <thead>
                                 <tr>
                                   <th>Question No.</th>
                                   <th>Question</th>
                                   <th>Your Answer</th>
                                   <th>True Answer</th>
                                   <th>Status</th>
                                 </tr>
                               </thead>
                               <tbody>
                                 <?php
                                 for ($i=0;$i<10;$i++) {
                                     $sql = "SELECT * FROM questions WHERE id  = '".$questionid[$i]."'";
                                     $records = mysqli_query($conn, $sql);

                                     $result = mysqli_fetch_assoc($records);
                                     echo "<tr>";
                                     echo "<td>".($i+1)."</td>";
                                     echo "<td>".$result['question']."</td>";
                                     // get the answer text from the number of option user selected
                                     switch ($userAnswers[$i]) {
                                     case 0:
                                         echo "<td>".$result['option1']."</td>";
                                         break;
                                     case 1:
                                         echo "<td>".$result['option2']."</td>";
                                         break;
                                     case 2:
                                         echo "<td>".$result['option3']."</td>";
                                         break;
                                     case 3:
                                         echo "<td>".$result['option4']."</td>";
                                         break;
                                     default:
                                         echo "<td>Didn't Attend</td>";
                                   }
                                     // get the true Answer
                                     // get the answer text from the number of option selected
                                     switch ($result['answer']) {
                                     case 0:
                                         echo "<td>".$result['option1']."</td>";
                                         break;
                                     case 1:
                                         echo "<td>".$result['option2']."</td>";
                                         break;
                                     case 2:
                                         echo "<td>".$result['option3']."</td>";
                                         break;
                                     case 3:
                                         echo "<td>".$result['option4']."</td>";
                                         break;
                                     default:
                                         echo "<td>Didn't Attend</td>";
                                   }
                                     // answer status
                                     if ($result['answer'] == $userAnswers[$i]) {
                                         echo "<td style='color: green;'>Correct</td>";
                                     } else {
                                         echo "<td style='color: red;'>Wrong</td>";
                                     }
                                     echo "</tr>";
                                 }

                                 // close database connection
                                 mysqli_close($conn);


                                 ?>
                               </tbody>
                             </table>
                             <br>
                               <label for="comment">Enter any Comment about the Quiz: </label>
                               <textarea type="text" class="form-control" name="comment" id="comment"> </textarea>  <br>
                               <button type="submit" id="done" style="width:25%;" class="btn btn-primary">Done</button>
                           </center>
                         </div>
                       </div>
                     </form>

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

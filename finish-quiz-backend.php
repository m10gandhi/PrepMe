<?php

  session_start();
  $user_id = $_SESSION["user_id"];
  // $user_id = 1;
  $cat_id = $_SESSION['cat_id'];
  $comment = $_POST['comment'];
  $score = $_SESSION['score'];
  $date = date("Y-m-d");

  // $conn = mysqli_connect('db.cs.dal.ca', 'vala', 'B00785077', 'vala');
  // $conn = mysqli_connect('localhost', 'root', '', 'assignent3');
  $servername = "cloud-a3.cnuacuuti7fl.us-east-2.rds.amazonaws.com";
  $username = "vamshi";
  $password = "599-5Me-SSV-7SU";
  $dbname = "prepMe";

  // $conn = mysqli_connect('db.cs.dal.ca', 'vala', 'B00785077', 'vala');
  // $conn = mysqli_connect('localhost', 'root', '', 'assignent3');
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  $sql = "INSERT INTO quiz (user_id,cat_id,comment,score,date) VALUES
   ('".$user_id."', '".$cat_id."', '".$comment."', '".$score."', CAST('".$date."' AS DATE))";

   echo $sql;

   if (mysqli_query($conn, $sql)) {
       header('Location: dashboard.php');
   } else {
       echo "error";
   }

   mysqli_close($conn);

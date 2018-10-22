<?php

  $userAnswers = json_decode($_POST['userAnswers'], true);

  session_start();
  $questionid = $_SESSION["questionid"];

  // $conn = mysqli_connect('db.cs.dal.ca', 'vala', 'B00785077', 'vala');
  // $conn = mysqli_connect('localhost', 'root', '', 'assignent3');
  $servername = "cloud-a3.cnuacuuti7fl.us-east-2.rds.amazonaws.com";
  $username = "vamshi";
  $password = "599-5Me-SSV-7SU";
  $dbname = "prepMe";

  // $conn = mysqli_connect('db.cs.dal.ca', 'vala', 'B00785077', 'vala');
  // $conn = mysqli_connect('localhost', 'root', '', 'assignent3');
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  $count = 0;
  $result = [];
  for ($i=0;$i<10;$i++) {
      $sql = "SELECT answer FROM questions WHERE id  = '".$questionid[$i]."'";
      $records = mysqli_query($conn, $sql);

      $true_answer = mysqli_fetch_assoc($records);

      if ($true_answer['answer'] == $userAnswers[$i]) {
          $count++;
          array_push($result, 1);
      } else {
          array_push($result, 0);
      }
  }
  $_SESSION["count"] = $count;
  $_SESSION["questionid"] = $questionid;
  echo $userAnswers;
  $_SESSION["userAnswers"] = $userAnswers;

  header('Location: quiz-result.php');

  mysqli_close($conn);

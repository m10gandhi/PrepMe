<?php

  $category = $_POST['category'];
  $question = $_POST['question'];
  $option1 = $_POST['option1'];
  $option2 = $_POST['option2'];
  $option3 = $_POST['option3'];
  $option4 = $_POST['option4'];
  $answer =  $_POST['answer'];

  $servername = "cloud-a3.cnuacuuti7fl.us-east-2.rds.amazonaws.com";
  $username = "vamshi";
  $password = "599-5Me-SSV-7SU";
  $dbname = "prepMe";

  // $conn = mysqli_connect('db.cs.dal.ca', 'vala', 'B00785077', 'vala');
  // $conn = mysqli_connect('localhost', 'root', '', 'assignent3');
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  $sql = "INSERT INTO questions (question,option1,option2,option3,option4,answer,cat_id) VALUES
   ('".$question."', '".$option1."', '".$option2."', '".$option3."', '".$option4."', '".$answer."' ,
   (SELECT id FROM category WHERE cat_name = '".$category."'))";

  if (mysqli_query($conn, $sql)) {
      header('Location: index.php');
  } else {
      echo "error";
  }

  mysqli_close($conn);

<?php

  $category = $_POST['category'];


  // $conn = mysqli_connect('db.cs.dal.ca', 'vala', 'B00785077', 'vala');
  // $conn = mysqli_connect('localhost', 'root', '', 'assignent3');
  $servername = "cloud-a3.cnuacuuti7fl.us-east-2.rds.amazonaws.com";
  $username = "vamshi";
  $password = "599-5Me-SSV-7SU";
  $dbname = "prepMe";

  // $conn = mysqli_connect('db.cs.dal.ca', 'vala', 'B00785077', 'vala');
  // $conn = mysqli_connect('localhost', 'root', '', 'assignent3');
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  $catIdSql = "SELECT id FROM category WHERE cat_name = '".$category."'";
  $catRecords = mysqli_query($conn, $catIdSql);
  $cat = mysqli_fetch_assoc($catRecords);
  $cat_id = $cat['id'];

  $sql = "SELECT * FROM questions WHERE cat_id = '".$cat_id."'";
  $records = mysqli_query($conn, $sql);

  // generate 10 random numbers lower than the total number of rows
  $row_count = mysqli_num_rows($records);
  $array = array();
  while (sizeof($array) < 10) {
      $rand = rand(1, $row_count);
      if (! in_array($rand, $array)) {
          array_push($array, $rand);
      }
  }

  $arrayjson = array();

  $question_bank = array();
  for ($i = 0; $i < 10; $i++) {
      $sql = "SELECT * FROM questions WHERE id = ".$array[$i];
      $records = mysqli_query($conn, $sql);

      while ($question = mysqli_fetch_assoc($records)) {
          $subjson = new stdClass();
          $subjson->question = $question['question'];
          $subjson->options = array($question['option1'],$question['option2'],$question['option3'],$question['option4']);
          array_push($arrayjson, $subjson);
      }
  }

  $json = new stdClass();
  $json->questions = $arrayjson;

  $bad_quizdata = json_encode($json);
  $good_quizdata = str_replace('\\', '', $bad_quizdata);

  echo $bad_quizdata;

  session_start();
  $_SESSION["quiz"] = $good_quizdata;
  $_SESSION["questionid"] = $array;
  $_SESSION["cat_id"] = $cat_id;

  header('Location: quiz.php');

  mysqli_close($conn);

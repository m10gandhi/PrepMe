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
    <link href="css/normalize.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/quiz.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <link type="text/css" rel="stylesheet" href="css/snackbar.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</head>

<body>
    <!-- 		<nav class="navbar sticky-top navbar-dark bg-dark">
			<a class="navbar-brand" href="index.php">Go Home</a>
		</nav> -->
    <!-- <div class="topnav" id="myTopnav">
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
             <ul class="nav-sidebar" style="color:#999999;">
                 <li class="sidebar-inner">
                    <a onclick="canNotNavigate()">
                         <b>Prep Me</b>
                     </a>
                 </li>
                 <li>
                     <a onclick="canNotNavigate()">Dashboard</a>
                 </li>
                 <li>
                     <a onclick="canNotNavigate()">Quiz Score</a>
                 </li>
                 <li>
                     <a onclick="canNotNavigate()">Groups</a>
                 </li>
                 <li>
                     <a onclick="canNotNavigate()">Settings</a>
                 </li>
                 <li>
                     <a onclick="canNotNavigate()">Logout</a>
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
               <h3 class="text-center mt-2 mb-2">Take a Quiz</h3>
               <div class="row">
                   <div class="col-12">
                       <div class="row">
                           <div class="col-1 col-md-2">
                               <img class="question-navigators" src="images/baseline_arrow_back_black_48dp.png" id="prevQuestion" onclick="navigateQuestions(this)">
                           </div>

                           <div id="quizContainer" class="quizContainer border border-secondary rounded p-3 col-10 col-md-8">
                               <div class="question">
                                   <!-- <p> Choose a correct option</p> -->
                               </div>
                               <br><hr>
                               <div class="options">

                               </div>
                           </div>
                           <div class="col-1 col-md-2">
                               <img class="question-navigators" src="images/baseline_arrow_forward_black_48dp.png" id="nextQuestion" onclick="navigateQuestions(this)">
                           </div>
                       </div>
                       <div class="row justify-content-center">
                           <div class="indicator">
                               <!-- <h3>2/3</h3> -->
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       		<br><br>

           <form id="quizAction" method="post" action="generate-result-backend.php">
             <center>
               <textarea id="userAnswers" readonly=readonly style="display: none;" name="userAnswers"></textarea>
               <button type="button" id="finish_quiz" onclick="finishQuiz()" style="width:25%; display: none;" class="btn btn-primary">Finish Quiz</button><br><br>
               <button type="button" id="get_quiz_record" style="width:25%;" class="btn btn-danger" style="width:25%;" onclick="cancelQuiz()">Cancel Quiz</button><br><br>
               <p id="confirmDialog" style="display: none;">Are you Sure?</p><br>
               <button type="submit" id="yesButton" style="width:10%; display: none;" class="btn btn-success">Yes</button><br>
               <button type="button" id="noButton" onclick="resumeQuiz()" style="width:10%; display: none;" class="btn btn-danger">No</button>

             </center>
           </form>
             </div>
         </div>
         <!-- /#page-content-wrapper -->
     </div>


    <?php
            // session_start();
            // echo $_SESSION["quiz"];
            $quiz = $_SESSION["quiz"];
        ?>

    <p id="quizdata" style="display: none;"><?php echo $quiz; ?></p>
    <script src="js/moduleQuiz.js"></script>
    <script src="js/app.js"></script>
    <script>
    $("#men-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>


    <div id="snackbar"><p id="snackeyText"></p></div>
</body>

</html>

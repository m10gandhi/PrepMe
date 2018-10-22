<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
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
                   <a href="dashadmin.php">Dashboard</a>
               </li>
               <li>
                   <a href="upload_topic.php">Add Topics</a>
               </li>
               <li>
                   <a href="dashadmin_addposts.php">Add Posts in Topics</a>
               </li>
               <li>
                   <a href="add-question.php">Add questions in quiz</a>
               </li>
               <li>
                   <a href="dashusers.php">Users</a>
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
           <br>
           <div class="container-fluid">
               <div class="container jumbotron">
                   <center>
                       <h3>Please Enter Following Information to Add a Question</h3>
                       <br>
                       <br>
                       <form class="col-16" method="post" action="add-question-backend.php">
                           <div class="form-group">
                               <label class="col-form-label col-10" for="category">Select Category:&nbsp;&nbsp;&nbsp;
                                   <select class="form-control col-2" style="display: inline-block;" name="category" id="category">
                                       <?php
                                         while ($category = mysqli_fetch_assoc($records)) {
                                             echo "<option>".$category['cat_name']."</option>";
                                         }
                                         mysqli_close($conn);
                                       ?>
                                   </select>
                               </label>
                           </div>

                           <div class="form-group">
                               <label class="col-form-label col-6" for="question">Question:
                                   <input type="text" class="form-control col-8" style="display: inline;" name="question" id="question" required/> </label>
                           </div>

                           <div class="form-group">
                               <label class="col-form-label col-6" for="option1">Option1:
                                   <input type="text" class="form-control col-8" style="display: inline;" name="option1" id="option1" required/> </label>
                           </div>

                           <div class="form-group">
                               <label class="col-form-label col-6" for="option2">Option2:
                                   <input type="text" class="form-control col-8" style="display: inline;" name="option2" id="option2" required/> </label>
                           </div>

                           <div class="form-group">
                               <label class="col-form-label col-6" for="option3">Option3:
                                   <input type="text" class="form-control col-8" style="display: inline;" name="option3" id="option3" required/> </label>
                           </div>

                           <div class="form-group">
                               <label class="col-form-label col-6" for="option4">Option4:
                                   <input type="text" class="form-control col-8" style="display: inline;" name="option4" id="option4" required/> </label>
                           </div>

                           <div class="form-group">
                               <label class="col-form-label col-6" for="answer">Answer:
                                   <input type="text" class="form-control col-8" style="display: inline;" name="answer" id="answer" required/> </label>
                           </div>

                           <br>
                           <input style="width:auto;" type="submit" class="btn btn-primary" name="add_question" value="Add Question" required/>
                       </form>

                   </center>
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
</body>

</html>

<?php
// Start the session
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
    <title>PrepInterview</title>
    <link href="css/normalize.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/hover.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/group_page.css">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap_customized.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    <script src="js/app.js"></script>
    <script src="js/moduleGroups.js"></script>
  </head>
  <body>

    <?php
    require 'db_connection.php';
    require 'utilities.php';
    connect_to_db();
    ?>
    <?php
    $target_dir = "uploads/";
    $uploadOk = 1;
    if (isset($_POST["newTopicSubmit"])) {
        $content = $topic_id = "";
        $topic_id_error = $content_error = $file_error = "";
        if (empty($_POST["content"])) {
            $content_error = "Content is required";
        } else {
            $content = test_input($_POST["content"]);
        }
        if (empty($_POST["topic_id"])) {
            $topic_id_error = "topic_id is required";
        } else {
            $topic_id = test_input($_POST["topic_id"]);
        }
        //and !(!isset($_FILES['upfile']['error']) || is_array($_FILES['upfile']['error'])))
        if ($content_error == "" and $tags_error == "") {
            if ($_FILES["fileToUpload"]["name"] == "") {
                uploadPostContentToDB($content, $topic_id, "", "text");
            } else {
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                // echo $_FILES["fileToUpload"]["name"];
                $new_file_name = (string)(uniqid('', false)) . '.' . $imageFileType;
                // . '.' . $imageFileType;
                // $temp_file_name1 = str_replace($new_file_name, ".", "-");
                // $new_file_name2 = $temp_file_name1 . '.' . $imageFileType;
                // echo $new_file_name;
                // $new_file_name = str_replace((string)(uniqid('', true)), ".", "-");
                $target_file_name = $target_dir . basename($new_file_name);
                // echo $target_file_name;
                // $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                // if ($check !== false) {
                //     // echo "File is an image - " . $check["mime"] . ".";
                //     $uploadOk = 1;
                // } else {
                //     // echo "File is not an image.";
                //     $file_error = "File is not an image.";
                //     $uploadOk = 0;
                // }
                if (file_exists($target_file_name)) {
                    // echo "Sorry, file already exists.";
                    $file_error = "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                //Check file size
                // if ($_FILES["fileToUpload"]["size"] > 500000) {
                //     echo "Sorry, your file is too large.";
                //     $uploadOk = 0;
                // }
                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf") {
                    // echo "Sorry, only PDF, JPG, JPEG, PNG & GIF files are allowed.";
                    $file_error .= "Sorry, only PDF, JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $file_error .= "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file_name)) {
                        echo "";
                        // echo "The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded.";
                        uploadPostContentToDB($content, $topic_id, $new_file_name, $imageFileType);
                    } else {
                        $file_error .= "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }
    }
    ?>
    <?php
    function uploadPostContentToDB($content, $topic_id, $filename, $type)
    {
        global $conn;
        $username = 3;
        $user_fullname = "admin";
        $today = date("Y-m-d H:i:s");
        // echo $tags;
        // echo $conn;
        if ($conn) {
            // echo "connection present";
            // echo $filename . $username . $groupId . $type;
            try {
                $stmt = $conn->prepare("INSERT INTO topic_posts (post_type, post_content, created_at, topic_id, created_by_user, post_file, created_by_username) VALUES (:post_type, :post_content, :created_at, :topic_id, :created_by_user, :post_file, :created_by_username)");
                $stmt->bindParam(':post_type', $type);
                $stmt->bindParam(':post_content', $content);
                $stmt->bindParam(':created_at', $today);
                $stmt->bindParam(':topic_id', $topic_id);
                $stmt->bindParam(':created_by_user', $username);
                $stmt->bindParam(':post_file', $filename);
                $stmt->bindParam(':created_by_username', $user_fullname);

                $stmt->execute();
            } catch (PDOException $e) {
                // echo "Unable to process your request. Please try later";
                echo $e->getMessage();
            }
            close_connection_to_db();
        } else {
            echo "no connection";
        }
    }
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
             <div class="container-fluid">
                 <!-- <a href="#menu-toggle" class="btn btn-default" id="men-toggle">Toggle Menu</a> -->
                 <div class="row">
                     <div class="col-lg-12">
                       <div class="container">

                         <div class="add_post_pane">
                           <p><b>Create new post for a topic</b></p>
                           <form enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                             <div class="form-group">
                               <input type="text" class="form-control" id="topic_id" name="topic_id" placeholder="Enter topic id">
                               <span class="error-message"> <?php echo $topic_id_error;?></span>
                             </div>
                             <div class="form-group">
                               <textarea name="content" class="col-12" placeholder="Enter text here... "></textarea>
                               <span class="error-message"> <?php echo $content_error;?></span>
                             </div>
                             <!-- Upload something: -->
                             <div class="form-group">
                               <p>Add a file</p>
                               <input type="file" name="fileToUpload" id="fileToUpload"><br>
                               <span class="error-message"> <?php echo $file_error;?></span>
                             </div>
                             <input type="submit" class="btn btn-light col-12" value="Post" name="newTopicSubmit">
                           </form>
                         </div>
                         <br>
                       </div>
                     </div>

                 </div>
             </div>
         </div>

     </div>
    <script>
    $("#men-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
    <!-- Button trigger modal -->
  </body>
</html>

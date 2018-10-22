<?php
// Start the session
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
}

if ($_GET['group_id'] != "") {
    $current_group_id = $_GET['group_id'];
    $current_group_name = $_GET['group_name'];
    $current_group_description = $_GET['group_description'];

    $_SESSION["current_group_id"] = $current_group_id;
    $_SESSION["current_group_name"] = $current_group_name;
    $_SESSION["current_group_description"] = $current_group_description;
}

// echo $current_group_id;
// echo $current_group_name;
// echo $current_group_description;

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
    if (isset($_POST["newPostSubmit"])) {
        $content = $tags = "";
        $tags_error = $content_error = $file_error = "";
        if (empty($_POST["content"])) {
            $content_error = "Content is required";
        } else {
            $content = test_input($_POST["content"]);
        }
        if (empty($_POST["tags"])) {
            $tags_error = "Tags are required";
        } else {
            $tags = test_input($_POST["tags"]);
        }
        //and !(!isset($_FILES['upfile']['error']) || is_array($_FILES['upfile']['error'])))
        if ($content_error == "" and $tags_error == "") {
            if ($_FILES["fileToUpload"]["name"] == "") {
                uploadPostContentToDB($content, $tags, "", $_SESSION["user_id"], $_SESSION["current_group_id"], "text", $_SESSION["user_name"]);
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
                        uploadPostContentToDB($content, $tags, $new_file_name, $_SESSION["user_id"], $_SESSION["current_group_id"], $imageFileType, $_SESSION["user_name"]);
                    } else {
                        $file_error .= "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }
    }
    ?>
    <?php
    function uploadPostContentToDB($content, $tags, $filename, $username, $groupId, $type, $user_fullname)
    {
        global $conn;
        $today = date("Y-m-d H:i:s");
        // echo $tags;
        // echo $conn;
        if ($conn) {
            // echo "connection present";
            // echo $filename . $username . $groupId . $type;
            try {
                $stmt = $conn->prepare("INSERT INTO posts (post_type, post_content, created_at, tags, group_id, created_by_user, post_file, created_by_username) VALUES (:post_type, :post_content, :created_at, :tags, :group_id, :created_by_user, :post_file, :created_by_username)");
                $stmt->bindParam(':post_type', $type);
                $stmt->bindParam(':post_content', $content);
                $stmt->bindParam(':created_at', $today);
                $stmt->bindParam(':tags', $tags);
                $stmt->bindParam(':group_id', $groupId);
                $stmt->bindParam(':created_by_user', $username);
                $stmt->bindParam(':post_file', $filename);
                $stmt->bindParam(':created_by_username', $user_fullname);

                // echo $stmt;
                $stmt->execute();
                // echo "query successful";
                // echo '<script>modGroup.callJavascipt("Hello");</script>';
                // $x = array(
                //   "content"  => $content,
                //   "tags" => $tags,
                //   "username" => $username,
                //   "created_at" => $today,
                //   "groupId" => $groupId,
                //   "type" => $type,
                //   "filename" => $filename
                //   );
                // echo '<script>modGroup.addCurrentPost(' . json_encode($x) .');</script>';
                //INSERT POST TO WALL
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
    <?php
    if (isset($_POST["loadMorePosts"])) {
        echo "loadmoreposts";
    }

    if (isset($_POST["addMemberToGroup"])) {
        $user_names = "";
        $usernames_error = "";
        if (empty($_POST["usernames"])) {
            $usernames_error = "username is needed";
            // if (preg_match('/\s/', $_POST["usernames"])) {
            //     echo "true";
            //     $usernames_error = "username cannot contain spaces";
            // }
        } else {
            $user_names = test_input($_POST["usernames"]);
        }
        if ($usernames_error == "") {
            // echo $group_name . $group_description;
            addMembersToGroup($user_names);
        }
    }
    ?>
    <?php
    function addMembersToGroup($user_names)
    {
        connect_to_db();
        global $conn,$usernames_error;
        $today = date("Y-m-d H:i:s");
        $temp_user_id = 10;
        // $tags = "tags";
        // echo $conn;
        if ($conn) {
            // echo "connection present";
            // echo $group_name . $group_description . $current_group_id . $_SESSION["current_group_id"];
            try {
                $stmt1 = $conn->prepare("select id from users where email = :email");
                $stmt1->bindParam(':email', $user_names);
                $stmt1->execute();
                $data = array();
                foreach (new RecursiveArrayIterator($stmt1->fetchAll()) as $key => $value) {
                    $data[$key] = $value;
                    // echo json_encode($value);
                        // echo '<script>modGroup.callJavascipt(" '+ json_encode($value)+ '");</script>';
                };
                // echo json_encode($data);
                if (count($data) == 1) {
                    // echo $data[0]["id"];
                    $stmt = $conn->prepare("INSERT INTO group_members (group_id, member_id, added_by) VALUES (:group_id, :member_id, :added_by);");
                    $stmt->bindParam(':group_id', $_SESSION["current_group_id"]);
                    $stmt->bindParam(':member_id', $data[0]["id"]);
                    $stmt->bindParam(':added_by', $_SESSION["user_id"]);

                    $stmt->execute();

                    // echo "query successful";
                }
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
    <!-- <div class="topnav sticky-top" id="myTopnav">
      <a href="index.php" >Home</a>
      <a href="populateTopicNames.php">Topics</a>
      <a href="groups.php" class="active">Groups</a>
      <a href="#contact">Contact</a>
      <a href="#about">About</a>
      <a href="javascript:void(0);" class="icon" onclick="navigationMenu()">
        <i class="fa fa-bars"></i>
      </a>
      <div class="topnav-right">
        <a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>
        <a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign up</a>
      </div>
    </div> -->
    <!-- <div class="leftMenu col-0">
    </div> -->

    <!-- Modal -->
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
                       <div class="container">
                         <div class="bordered-body">
                             <p><b>Group Details</b></p>
                           <h3><?php
                           if ($_SESSION["current_group_id"]) {
                               echo $_SESSION["current_group_id"] . " - " . $_SESSION["current_group_name"];
                           } else {
                               echo "No group id present";
                           }

                           ?></h3>
                           <p><?php
                           if ($_SESSION["current_group_description"]) {
                               echo $_SESSION["current_group_description"];
                           } else {
                               echo "No group description is present";
                           }

                           ?></p>
                           <!-- <button type="button" class="btn btn-light col-12 mt-1" name="button" data-toggle="modal" data-target="#AddMembersToGroupModal" data-backdrop="static" data-keyboard="false">Add People to the group</button>         -->
                           <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                             <div class="row">
                               <div class="form-group col-md-8 col-sm-8 col-xs-6">
                                 <input type="text" class="form-control" id="usernames" name="usernames" placeholder="Enter email of a person">
                                 <span class="error-message"> <?php echo $usernames_error;?></span>
                               </div>
                               <div class="form-group col-md-4 col-sm-4 col-xs-6">
                                 <input type="submit" class="btn btn-light col-12" value="Add Member" name="addMemberToGroup">
                               </div>
                             </div>
                           </form>
                         </div>
                         <div class="add_post_pane">
                           <p><b>Create new post</b></p>
                           <form enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                             <div class="form-group">
                               <textarea name="content" class="col-12" placeholder="Enter text here... "></textarea>
                               <span class="error-message"> <?php echo $content_error;?></span>
                             </div>
                             <div class="form-group">
                               <input type="text" class="form-control" id="tags" name="tags" placeholder="Enter tags ">
                               <span class="error-message"> <?php echo $tags_error;?></span>
                             </div>
                             <!-- Upload something: -->
                             <div class="form-group">
                               <input type="file" name="fileToUpload" id="fileToUpload"><br>
                               <span class="error-message"> <?php echo $file_error;?></span>
                             </div>
                             <input type="submit" class="btn btn-light col-12" value="Post" name="newPostSubmit">
                           </form>
                         </div>
                         <div class="posts_pane" id="posts_pane">
                           <?php
                           // if ($x) {
                           //     echo '<script>modGroup.addCurrentPost(' . json_encode($x) .');</script>';
                           // }

                           function getAllPosts($groupId)
                           {
                               connect_to_db();
                               global $conn;

                               if ($conn) {
                                   try {
                                       $stmt = $conn->prepare("select * from posts where group_id = :group_id order by post_id desc");
                                       $stmt->bindParam(':group_id', $groupId);

                                       $stmt->execute();
                                       $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                       // $x = $stmt->fetchAll();
                                       // foreach ($x as $key => $value) {
                                       //     echo $key . $value;
                                       // }
                                       $posts_array = array();
                                       foreach (new RecursiveArrayIterator($stmt->fetchAll()) as $key => $value) {
                                           $posts_array[$key] = $value;
                                           // echo json_encode($value);
                                       }
                                       if (count($posts_array) == 0) {
                                           echo '<br><div class="post"><br><p><b>No posts to display</b></p></div>';
                                       } else {
                                           addPostsToUI($posts_array);
                                       }
                                       // echo "query successful";
                                   } catch (PDOException $e) {
                                       // echo "Unable to process your request. Please try later";
                                       echo $e->getMessage();
                                   }
                                   close_connection_to_db();
                               } else {
                                   echo "no connection";
                               }
                           }

                           function addPostsToUI($posts_array)
                           {
                               // echo json_encode($posts_array);
                               for ($x = 0; $x < count($posts_array); $x++) {
                                   switch ($posts_array[$x]["post_type"]) {
                                     case "pdf":
                                         addPDFPostToUI($posts_array[$x]);
                                         break;
                                     case "text":
                                         addTextPostToUI($posts_array[$x]);
                                         break;
                                     case "jpg":
                                     case "jpeg":
                                     case "png":
                                     case "gif":
                                         addImagePostToUI($posts_array[$x]);
                                         break;
                                     default:
                                         echo "";
                                 }
                                   // addCurrentPostToUI($posts_array[$x]);

                                   // $group_id = $data[$x]["group_id"];
                                   // $group_name = $data[$x]["group_name"];
                                   // $group_description = $data[$x]["group_description"];
                                   // // echo json_encode($data);
                                   // // echo "The number is: $group_id, $group_name, $group_description <br>";
                                   // echo "<button type= 'button' class='btn btn-light col-12 mb-2' onclick=\"window.location.href='group_page.php?group_id=$group_id&group_name=$group_name&group_description=$group_description'\">$group_name</button>";
                               }
                           }

                           function addPDFPostToUI($post)
                           {
                               // echo json_encode($post);
                               // $postedBy = $post["created_by_user"];
                               $postedBy = $post["created_by_username"];
                               $postCreatedTime = $post["created_at"];
                               $postTags = $post["tags"];
                               $postContent = $post["post_content"];
                               $postFileUrl = "https://prepme.herokuapp.com/uploads/" . $post["post_file"];
                               echo '<div class="post">
                                 <div class="post_header">
                                   <p><b>Posted by ' . $postedBy . '</b><br>' . $postCreatedTime . '<br>' . $postTags . '
                                   </p>
                                 </div>
                                 <div class="post_content">
                                   <p>' . $postContent .'</p>
                                   <button type="button" class="btn btn-outline-secondary mb-1" data-toggle="modal" data-whatever="' . $postFileUrl . '" data-target="#exampleModal" data-backdrop="static" data-keyboard="false">
                                   Click to view PDF
                                   </button>
                                 </div>
                               </div>';
                           }

                           function addImagePostToUI($post)
                           {
                               // echo json_encode($post);
                               // $postedBy = $post["created_by_user"];
                               $postedBy = $post["created_by_username"];
                               $postCreatedTime = $post["created_at"];
                               $postTags = $post["tags"];
                               $postContent = $post["post_content"];
                               $postFileUrl = "https://prepme.herokuapp.com/uploads/" . $post["post_file"];

                               echo '<div class="post">
                                 <div class="post_header">
                                   <p><b>Posted by ' . $postedBy . '</b><br>' . $postCreatedTime . '<br>' . $postTags . '
                                   </p>
                                 </div>
                                 <div class="post_content">
                                   <p>' . $postContent .'</p>
                                   <img src="' . $postFileUrl . '"></img>
                                 </div>
                               </div>';
                           }

                           function addTextPostToUI($post)
                           {
                               // echo json_encode($post);
                               // $postedBy = $post["created_by_user"];
                               $postedBy = $post["created_by_username"];
                               $postCreatedTime = $post["created_at"];
                               $postTags = $post["tags"];
                               $postContent = $post["post_content"];

                               echo '<div class="post">
                                 <div class="post_header">
                                   <p><b>Posted by ' . $postedBy . '</b><br>' . $postCreatedTime . '<br>' . $postTags . '
                                   </p>
                                 </div>
                                 <div class="post_content">
                                   <p>' . $postContent .'</p>
                                 </div>
                               </div>';
                           }

                           getAllPosts($_SESSION["current_group_id"]);
                           ?>
                           <!-- <div class="post">
                             <div class="post_header">
                               <p><b>Posted by </b><br> Time <br> Tags
                               </p>
                             </div>
                             <canvas id="the-canvas"></canvas>
                             <br>
                             <button class="btn btn-outline-dark col-4" id="prev">Previous</button>
                             <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
                             <button class="btn btn-outline-dark col-4 mb-1 ml-1" id="next">Next</button> &nbsp; &nbsp;
                           </div> -->
                           <!-- <div class="post">
                             <div class="post_header">
                               <p><b>Posted by </b><br> Time <br> Tags
                               </p>
                             </div>
                             <img src="images/giphy9.gif"></img>
                           </div>
                           <div class="post">
                             <div class="post_header">
                               <p><b>Posted by </b><br> Time <br> Tags
                               </p>
                             </div>
                             <div class="post_content">
                               <img src="images/giphy9.gif"></img>
                             </div>
                           </div>
                           <div class="post">
                             <div class="post_header">
                               <p><b>Posted by </b><br> Time <br> Tags
                               </p>
                             </div>
                             <div class="post_content">
                               <p>Hello world</p>
                             </div>
                           </div> -->
                           <!-- <div class="post">
                             <div class="post_header">
                               <p><b>Posted by </b><br> Time <br> Tags
                               </p>
                             </div>
                             <div class="post_content">
                               <p>Hello world</p>
                               <button type="button" class="btn btn-outline-secondary mb-1" data-toggle="modal" data-whatever="http://localhost:8888/web-temp-project/uploads/5b59d7e50f420.pdf" data-target="#exampleModal" data-backdrop="static" data-keyboard="false">
                               Click to view PDF
                               </button>
                             </div>
                           </div> -->
                         </div>
                         <!-- <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                           <div class="form-group">
                             <input type="hidden" id="currentPostCount" name="currentPostCount" value="10">
                             <button type="submit" class="btn btn-outline-dark col-12" name="loadMorePosts" id="loadMoreBtn">Load more posts</button>
                           </div>
                         </form> -->
                         <br>
                       </div>
                     </div>

                 </div>
             </div>
         </div>

     </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="posts_pane">
              <div class="pdfViewer">
                <canvas id="the-canvas"></canvas>
                <br>
                <button class="btn btn-outline-dark col-4" id="prev">Previous</button>
                <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
                <button class="btn btn-outline-dark col-4 mb-1 ml-1" id="next">Next</button>
                <!-- &nbsp; &nbsp; -->
              </div>
              <!-- <div class="modal-footer">
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="js/pdf_viewer.js"></script>
    <script>
    $('#exampleModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text("PDF Viewer");// + recipient);
    // var url = '//cdn.mozilla.net/pdfjs/tracemonkey.pdf';
    // var url = "http://localhost:8888/web-temp-project/uploads/5b59d7e50f420.pdf";

    pdfjsLib.getDocument(recipient).then(function(pdfDoc_) {
    pdfDoc = pdfDoc_;
    document.getElementById('page_count').textContent = pdfDoc.numPages;
    // Initial/first page rendering
    renderPage(pageNum);
    });
    });
    </script>
    <script>
    $("#men-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
    <!-- Button trigger modal -->
  </body>
</html>

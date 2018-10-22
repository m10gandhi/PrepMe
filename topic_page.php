<?php
// Start the session
session_start();

if ($_GET['iid'] != "") {
    $current_topic_id = $_GET['iid'];
    $current_topic_name = $_GET['topic_name'];
    $current_topic_description = $_GET['topic_description'];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        $files_fetch_url = "https://prepme.herokuapp.com/uploads/";
        $postedBy = $post["created_by_username"];
        $postCreatedTime = $post["created_at"];
        $postTags = $post["tags"];
        $postContent = $post["post_content"];
        $postFileUrl = $files_fetch_url . $post["post_file"];
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
        $files_fetch_url = "https://prepme.herokuapp.com/uploads/";
        $postedBy = $post["created_by_username"];
        $postCreatedTime = $post["created_at"];
        $postTags = $post["tags"];
        $postContent = $post["post_content"];
        $postFileUrl = $files_fetch_url . $post["post_file"];

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

    ?>

    <div class="topnav sticky-top" id="myTopnav">
      <a href="index.php" >Home</a>
      <a href="populateTopicNames.php" class="active">Topics</a>
      <a href="groups.php">Groups</a>
      <?php
      if (isset($_SESSION["user_id"])) {
          echo '<a href="dashboard.php">My Dashboard</a>';
      }
       ?>
      <!-- <a href="#contact">Contact</a>
      <a href="#about">About</a> -->
      <a href="javascript:void(0);" class="icon" onclick="navigationMenu()">
        <i class="fa fa-bars"></i>
      </a>
      <div class="topnav-right">
        <?php
if (isset($_SESSION["user_id"])) {
           echo '<a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>';
       } else {
           echo '<a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>
      <a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign up</a>';
       }
 ?>
      </div>
    </div>
    <div class="container">
      <div class="bordered-body">
          <p><b>Topic Details</b></p>
        <h3><?php
        if ($current_topic_id) {
            echo $current_topic_id . " - " . $current_topic_name;
        } else {
            echo "No topic id is present";
        }

        ?></h3>
        <p><?php
        if ($current_topic_description) {
            echo $current_topic_description;
        } else {
            echo "No topic description is present";
        }

        ?></p>

      </div>
      <div class="posts_pane" id="posts_pane">
        <?php


        function getAllPosts($topicId)
        {
            connect_to_db();
            global $conn;

            if ($conn) {
                try {
                    $stmt = $conn->prepare("select * from topic_posts where topic_id = :topic_id order by topic_id desc");
                    $stmt->bindParam(':topic_id', $topicId);

                    $stmt->execute();
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $posts_array = array();
                    foreach (new RecursiveArrayIterator($stmt->fetchAll()) as $key => $value) {
                        $posts_array[$key] = $value;
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

        getAllPosts($current_topic_id);
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
      <br>
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

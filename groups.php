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
    <link rel="stylesheet" type="text/css" href="css/groups.css">
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
    // echo $_SESSION["user_id"];
    require 'db_connection.php';
    require 'utilities.php';
    if (isset($_POST["newGroupSubmit"])) {
        $group_name = $group_description = "";
        $group_name_error = "";
        if (empty($_POST["groupName"])) {
            $group_name_error = "Content is required";
        } else {
            $group_name = test_input($_POST["groupName"]);
        }
        $group_description = test_input($_POST["groupDescription"]);
        if ($group_name_error == "") {
            // echo $group_name . $group_description;
            addANewGroup($group_name, $group_description, $_SESSION["user_id"]);
        }
    }

    function addANewGroup($group_name, $group_description, $current_user)
    {
        connect_to_db();
        global $conn;
        $today = date("Y-m-d H:i:s");
        $tags = "tags";
        // echo $conn;
        if ($conn) {
            // echo "connection present";
            // echo $group_name . $group_description;
            try {
                $stmt = $conn->prepare("INSERT INTO groups (group_name, group_description, group_admin, created_at) VALUES (:group_name, :group_description, :group_admin, :created_at)");
                $stmt->bindParam(':group_name', $group_name);
                $stmt->bindParam(':group_description', $group_description);
                $stmt->bindParam(':group_admin', $current_user);
                $stmt->bindParam(':created_at', $today);
                $stmt->execute();

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

    function getGroupsOfAMember($member_id)
    {
        connect_to_db();
        global $conn;
        if ($conn) {
            try {
                $stmt = $conn->prepare("select group_id, group_name, group_description from groups where group_id in (select group_id from group_members where member_id = :member_id);");
                $stmt->bindParam(':member_id', $member_id);
                $stmt->execute();
                // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                // $x = $stmt->fetchAll();
                // foreach ($x as $key => $value) {
                //     echo $key . $value;
                // }
                // $htmlstring
                $data = array();
                foreach (new RecursiveArrayIterator($stmt->fetchAll()) as $key => $value) {
                    $data[$key] = $value;
                    // echo json_encode($value);
                        // echo '<script>modGroup.callJavascipt(" '+ json_encode($value)+ '");</script>';
                }
                // echo json_encode($data);

                updateGroupDatainUI($data);
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
    ?>

    <?php
    function updateGroupDatainUI($data)
    {
        for ($x = 0; $x < count($data); $x++) {
            $group_id = $data[$x]["group_id"];
            $group_name = $data[$x]["group_name"];
            $group_description = $data[$x]["group_description"];
            // echo json_encode($data);
            // echo "The number is: $group_id, $group_name, $group_description <br>";
            echo "<button type= 'button' class='btn btn-light col-12 mb-2' onclick=\"window.location.href='group_page.php?group_id=$group_id&group_name=$group_name&group_description=$group_description'\">$group_name</button>";
        }
    };
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

                 <div class="container">
                   <div class="group-list">
                   </div>
                   <div class="bordered-body">
                     <p><b>Create new group</b></p>
                     <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                       <div class="form-group">
                         <input type="text" class="form-control" id="groupName" name="groupName" placeholder="Enter a group name">
                         <span class="error-message"> <?php echo $group_name_error;?></span>
                       </div>
                       <div class="form-group">
                         <textarea name="groupDescription" class="col-12" placeholder="Enter a brief description about the group"></textarea>
                       </div>
                       <div class="form-group">
                         <p>You can add group members after creating a group</p>
                       </div>
                       <input type="submit" class="btn btn-light col-12" value="Create" name="newGroupSubmit">
                     </form>
                   </div>

                     <div class="bordered-body">
                     <p><b>Your Groups</b></p>
                     <?php
                     getGroupsOfAMember($_SESSION["user_id"]);
                     ?>

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
  </body>
</html>

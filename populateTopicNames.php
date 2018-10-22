<?php
session_start();
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "membershipsystem";
//
// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
$servername = "cloud-a3.cnuacuuti7fl.us-east-2.rds.amazonaws.com";
$username = "vamshi";
$password = "599-5Me-SSV-7SU";
$dbname = "prepMe";

$conn = mysqli_connect($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM TopicDetails";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home page</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/hover.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/group_page.css">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap_customized.css">
    <link rel="stylesheet" type="text/css" href="css/populate.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/konpa/devicon/df6431e323547add1b4cf45992913f15286456d3/devicon.min.css">
</head>
<body>
  <div class="topnav" id="myTopnav">
      <a href="index.php" class="active">Home</a>
      <a href="populateTopicNames.php">Topics</a>
      <a href="groups.php">Groups</a>
      <?php
      if (isset($_SESSION["user_id"])) {
          echo '<a href="dashboard.php">My Dashboard</a>';
      }
       ?>
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
<div class="container-fluid">
  <br><br>
    <div class="jumbotron">

        <!-- <h1>PrepMe</h1> -->
        <p>Our website provides a learning platform to prepare yourselves for your upcoming interviews.
            You can join groups to interact with other members and view personalised contents.
            Quiz feature is also there to analyze your knowledge.</p>
    </div>
</div>

<div class="row match-to-row">
    <?php
    while ($row = mysqli_fetch_array($result)) {
        $topicName = $row['topic'];
        $imageName = $row['filename'];
        $RedirectLink = "topic_page.php?iid=" . $row['iid'] . '&topic_name=' . $row['topic'] . '&topic_description=' . $row['description']; ?>
    <div class="col-lg-2 col-sm-6">
        <div class="thumbnail">
            <?php
            echo "<a href='$RedirectLink'><img src='topics/" . $imageName . "'></a> "; ?>
            <p><?php echo $topicName; ?></p>
        </div>
    </div>
        <?php
    }
        ?>

</div>
<script src="js/app.js"></script>
</body>
</html>

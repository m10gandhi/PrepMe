<?php
$servername = "cloud-a3.cnuacuuti7fl.us-east-2.rds.amazonaws.com";
$username = "vamshi";
$password = "599-5Me-SSV-7SU";
$dbname = "prepMe";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = $conn->prepare('SELECT id, firstName, lastName, email FROM users');
    $query->execute();
    $result = $query -> fetchAll();
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
    <link href="css/normalize.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap_customized.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    <script src="js/app.js"></script>
  <link rel="stylesheet" type="text/css" href="css/dashboard.css">
</head>
<body>
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

                    </div>
                 <script>
    $("#men-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
                </div>
                <div class="row">
<div class="container">
  <h2>All Users</h2>
  <!-- <p>Change user status for activation:</p> -->
  <br><br>
  <table class="table">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
        <?php
        foreach ($result as $row) {
            $id = $row['id'];
            // $status = $row['active'];
?>
    <tr>
        <td><?php echo $row['firstName']; ?></td>
        <td><?php echo $row['lastName']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <!-- <td class="statuscolor"><?php
        // echo $status;
        ?></td>
        <td><button type="submit" name="submit">Change Status</button></td> -->
    </tr>
<?php
        }
?>
    </tbody>
  </table>
</div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
    </body>
</html>

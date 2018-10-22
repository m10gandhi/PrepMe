
<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Forgot Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/hover.css">
    <!-- <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
    <link href="css/normalize.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="CSS/common.css">

    <script>
        function alertbox() {
            alert("You will get password on your email if all the details that you have provided are correct!");
        }
    </script>
</head>

<body>
    <div class="topnav sticky-top" id="myTopnav">
        <a href="index.php" class="active">Home</a>
        <a href="populateTopicNames.php">Topics</a>
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
                <!-- <a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>
      <a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign up</a> -->
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="container">
        <form action="forgot_password.php" method="post">
            <div class="card text-center">
                <div class="card-header">
                    <h4>Forgot password?</h4>
                </div>
                <div class="card-body col-12">

                    <label for="email" class="col-form-label col-6">Email address: &nbsp;&nbsp;&nbsp; &nbsp;
                        <input type="email" name="email" class="form-control col-8" id="email" style="display: inline;" placeholder="Email address...">
                    </label>
                    <br>

                    <label for="secQues" class="col-form-label col-6">Security Question:
                        <select name="secQues" class="form-control col-8" style="display: inline;">
                            <option>Name of your first school</option>
                            <option>Name of your pet</option>
                            <option>Name of your favourite teacher</option>
                            <option>Name of your love</option>
                        </select>
                        <br>
                    </label>

                    <label for="secAns" class="col-form-label col-6">Security Answer:&nbsp;&nbsp;&nbsp;
                        <input type="text" id="security_ans" name="secAns" class="form-control col-8" style="display: inline;">
                    </label>
                    <br>
                    <button type="submit" style="width:auto;" class="btn btn-primary" onClick="alertbox()">Submit</button>

                </div>
            </div>
        </form>
    </div>
    <script src="js/app.js"></script>
</body>

</html>

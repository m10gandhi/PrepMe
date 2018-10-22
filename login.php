<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    require 'db_connection.php';
    require 'utilities.php';
    connect_to_db();

$login_username = $login_password = "";
$login_error = $passwordErr = $mainErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $login_username = test_input($_POST["login_username"]);
    if (empty($_POST["login_username"])) {
        $login_error = "Username is required";
    } else {
        $login_username = test_input($_POST["login_username"]);
    }
    // $login_password = trim($_POST["login_password"]);
    if (empty($_POST["login_password"])) {
        $passwordErr = "Password is required";
    } else {
        $login_password = trim($_POST["login_password"]);
    }
    if ($login_error == "" and $passwordErr == "") {
        validate_user($login_username, $login_password);
    } else {
        $mainErr = "There are some errors. Please try again";
    }
}

function validate_user($username, $password)
{
    global $conn, $login_error, $mainErr;
    $login_error = "";
    if ($conn) {
        try {
            $stmt = $conn->prepare("SELECT id, firstName, lastName, email, password FROM users WHERE email = :user_name LIMIT 1");
            $stmt->bindParam(':user_name', $username);
            $stmt->execute();
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $x = $stmt->fetchAll();
            foreach ($x as $key => $value) {
                // echo $key . $value["password_hash"];
                if (password_verify($password, $value["password"])) {
                    // echo 'Password is valid!';
                    $_SESSION["user_name"] = $value["firstName"] . " " . $value["lastName"];
                    $_SESSION["fname"] = $value["firstName"];
                    $_SESSION["lname"] = $value["lastName"];
                    $_SESSION["user_id"] = $value["id"];
                    $_SESSION["email"] = $value["email"];
                    if ($_SESSION["email"] == 'admin@prepme.com') {
                        header("Location: dashadmin.php");
                    } else {
                        header("Location: dashboard.php");
                    }
                } else {
                    $mainErr = 'Incorrect Username or Password. Please try again';
                }
                break;
            }
        } catch (PDOException $e) {
            $mainErr = 'There is some trouble. Please try again';
            // echo "Error: " . $e->getMessage();
        }
    }
}
?>
        <!-- 		<nav class="navbar sticky-top navbar-dark bg-dark">
<a class="navbar-brand" href="index.php">Go Home</a>
</nav> -->
        <div class="topnav" id="myTopnav">
            <a href="index.php">Home</a>
            <a href="populateTopicNames.php">Topics</a>
            <a href="groups.php">Groups</a>
            <a href="javascript:void(0);" class="icon" onclick="navigationMenu()">
                <i class="fa fa-bars"></i>
            </a>
            <div class="topnav-right">

                <?php
        if (isset($_SESSION["user_id"])) {
            echo '<a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>';
        } else {
            echo '<a href="login.php" class="active"><span class="glyphicon glyphicon-log-in"></span> Login</a>
              <a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign up</a>';
        }
         ?>
            </div>
        </div>
        <br>
        <div class="container-fluid">
            <div class="container jumbotron">
                <center>
                    <h1 class="text-center">Login</h1>
                    <br>
                    <br>
                    <form method="post" class="col-12" action="login.php">

                        <div class="form-group">
                            <label class="col-form-label col-12" for="login_username">Login:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="text" class="form-control col-6" style="display: inline;" placeholder="Username (E-mail)" name="login_username" id="login_username" required/>
                                <span class="error-message">* <?php echo $login_error;?></span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label col-12" for="option1">Password:
                                <input type="Password" class="form-control col-6" style="display: inline;" name="login_password" id="login_password" placeholder="Password" required/>
                                <span class="error-message">* <?php echo $passwordErr;?></span></label>
                        </div>



                        <span class="error-message"><?php echo $mainErr;?></span>
                        <br><br>
                        <input style="width:25%;" type="submit" class="btn btn-primary" value="Login" required/>

                        <br>
                        </br>
                        Don't have an account?<br><button type="button" style="width:auto%;" class="btn btn-outline-primary btn-sm" onclick="window.location.href='register.php'">Register Now</button>
                        <br>
                        <br>
                        <button type="button" style="width:auto%;" class="btn btn-outline-primary btn-sm" onclick="window.location.href='Forgot_pwd.php'">Forgot Password?</button>

                    </form>

                </center>
            </div>
        </div>
<script src="js/app.js"></script>
</body>

</html>

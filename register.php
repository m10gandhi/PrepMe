<!-- https://www.w3schools.com/howto/howto_css_responsive_form.asp-->
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/common.css">
    <link rel="stylesheet" type="text/css" href="CSS/register.css">
    <link rel="stylesheet" type="text/css" href="CSS/normalize.css">


</head>
<body>
  <div class="topnav" id="myTopnav">
      <a href="index.php">Home</a>
      <a href="populateTopicNames.php">Topics</a>
      <a href="groups.php">Groups</a>
      <a href="javascript:void(0);" class="icon" onclick="navigationMenu()">
          <i class="fa fa-bars"></i>
      </a>

      </div>
  </div>


<?php
// https://www.w3schools.com/php/php_form_validation.asp
// define variables and set to empty values
$fnameErr = $lnameErr = $emailErr = $passwordErr = $confirm_pwdErr = "";
$fname = $lname = $email = $pwd ="";
$flag = true;

// https://www.w3schools.com/php/showphp.asp?filename=demo_form_validation_special
// https://www.phpjabbers.com/php-validation-and-verification-php27.html
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["firstname"])) {
        $fnameErr = "Name is required";
        $flag = false;
    } else {
        $fname = test_input($_POST["firstname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $fname)) {
            $fnameErr = "Only letters and white space allowed";
            $flag = false;
        }
    }


    if (empty($_POST["lastname"])) {
        $lnameErr = "Last name is required";
        $flag = false;
    } else {
        $lname = test_input($_POST["lastname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $lname)) {
            $lnameErr = "Only letters and white space allowed";
            $flag = false;
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $flag = false;
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $flag = false;
        }
    }

    if (empty($_POST["pwd"])) {
        $passwordErr = "Password is required";
        $flag = false;
    } else {
        $password = test_input($_POST["pwd"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[\w+\s+0-9]{8,}$/", $password)) {
            $passwordErr = "Password must be at least 8 characters";
            $flag = false;
        }
    }

    if ($_POST["pwd"] === $_POST["confirm_password"]) {
        // success!
    } else {
        $confirm_pwdErr="Passwords do not match";
        $flag = false;
    }


    if ($flag) {
        session_start();
        $_SESSION = $_POST;
        header("Location: regphp.php");
        exit;
    }
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>



<hr>
<form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="container">
      <center><h1>Sign Up</h1></center>
      <hr></hr>
        <div class="row">
            <div class="col-25">
                <label for="fname"><b> First Name</b></label>
            </div>
            <div class="col-75">
                <input type="text" id="fname" name="firstname" placeholder="Your name.." value="<?php echo $fname;?>">
                <span class="error"> <?php echo $fnameErr;?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="lname"><b>Last Name</b></label>
            </div>
            <div class="col-75">
                <input type="text" id="lname" name="lastname" placeholder="Your last name.." value="<?php echo $lname;?>">
                <span class="error"> <?php echo $lnameErr;?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="email"><b>Email</b></label>
            </div>
            <div class="col-75">
                <input type="email" id="email" name="email" placeholder="Your email id.." value="<?php echo $email;?>">
                <span class="error"> <?php echo $emailErr;?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="pwd"><b>Password</b></label>
            </div>
            <div class="col-75">
                <input type="password" id ="pwd" name="pwd" placeholder="8 digit password">
                <span class="error"> <?php echo $passwordErr;?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="confirm_password"><b>Confirm password</b></label>
            </div>
            <div class="col-75">
                <input type="password" id ="confirm_password" name="confirm_password" placeholder="Re-enter above password">
                <span class="error"> <?php echo $confirm_pwdErr;?></span>
            </div>
        </div>

        <div class="row">
            <div class = "col-25">
                <label for ="security_ques"><b>Security question</b></label>
            </div>
            <div class="col-75">
                <select name ="secQues">
                    <option>Name of your first school</option>
                    <option>Name of your pet</option>
                    <option>Name of your favourite teacher</option>
                    <option>Name of your love</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class = "col-25">
                <label for ="security_ans"><b>Security answer</b></label>
            </div>
            <div class="col-75">
                <input type="text" id="security_ans" name="secAns">
            </div>
        </div>

        <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
        <div class="row">
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>
    </div>

</form>
<script src="js/app.js"></script>
</body>
</html>

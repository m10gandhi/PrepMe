<?php

// https://www.w3schools.com/php/php_mysql_insert.asp
session_start();

$_POST = $_SESSION;
$servername = "cloud-a3.cnuacuuti7fl.us-east-2.rds.amazonaws.com";
$username = "vamshi";
$password = "599-5Me-SSV-7SU";
$dbname = "prepMe";
$conn = mysqli_connect($servername, $username, $password, $dbname);

$firstname =$_POST['firstname'];
$lastname =$_POST['lastname'];
$email =$_POST['email'];
$pwd =$_POST['pwd'];
$hash =password_hash($pwd, PASSWORD_DEFAULT);

$sQues = mysqli_real_escape_string($conn, $_POST["secQues"]);
$sAns = mysqli_real_escape_string($conn, $_POST["secAns"]);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO users (firstName, lastName, email, password, secQues, secAns)
VALUES ('$firstname','$lastname','$email','$hash','$sQues','$sAns')";

if (mysqli_query($conn, $sql)) {
    // echo "New record created successfully";
    header("location: login.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

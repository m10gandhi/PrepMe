<?php
/**
 * Created by PhpStorm.
 * User: Abhi
 * Date: 2018-07-22
 * Time: 8:38 PM
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$servername = "cloud-a3.cnuacuuti7fl.us-east-2.rds.amazonaws.com";
$username = "vamshi";
$password = "599-5Me-SSV-7SU";
$dbname = "prepMe";
$connection = mysqli_connect($servername, $username, $password, $dbname);

// $connection = new mysqli('localhost','root','','membershipsystem');

function generateRandomString($length = 8)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


if ($_POST) {
    $email = $_POST['email'];
    $sQues =$_POST['secQues'];
    $sAns = $_POST['secAns'];
    $random =generateRandomString();

    $data = mysqli_query($connection, "SELECT * FROM users WHERE email='".$email."' AND secQues='".$sQues."' AND secAns='".$sAns."'  ") or die(mysqli_error($connection));
    $row = mysqli_fetch_array($data);
    $count = mysqli_num_rows($data);

    $hash =password_hash($random, PASSWORD_DEFAULT);
    $query = mysqli_query($connection, "UPDATE users SET password= '".$hash."' WHERE email='".$email."' ");
    if ($count > 0) {
        // https://github.com/PHPMailer/PHPMailer

        //Load Composer's autoloader
        require 'vendor/autoload.php';

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'abhispatel43@gmail.com';                 // SMTP username
            $mail->Password = 'Abhi1997';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('abhispatel43@gmail.com', 'PrepME');
            $mail->addAddress($email, $email);     // Add a recipient

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Forgot password';
            $mail->Body    = "Your password is {$random}";
            $mail->AltBody = "Your password is {$row['password']}";

            $mail->send();
            echo "<script>alert('Check your email id for password!');</script>";
        } catch (Exception $e) {
            echo 'Message could not be sent.';
        }
        header("location: index.php");
    } else {
        echo "<script>alert('You have not registered your email-id with us!');</script>";
        header("location: index.php");
    }
}

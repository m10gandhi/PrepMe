<?php

// $servername = db.cs.dal.ca";
// $username = "moogala";
// $password = "B00785801";
// $dbname = "moogala";

$servername = "cloud-a3.cnuacuuti7fl.us-east-2.rds.amazonaws.com";
$username = "vamshi";
$password = "599-5Me-SSV-7SU";
$dbname = "prepMe";

function connect_to_db()
{
    global $servername, $username, $password, $dbname, $conn;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
    } catch (PDOException $e) {
        // echo "Connection failed: " . $e->getMessage();
    }
}


function close_connection_to_db()
{
    global $conn;
    $conn = null;
}
?>
<!--  -->

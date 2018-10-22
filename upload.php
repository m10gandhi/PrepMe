<?php
$fileExistsFlag = 0;
$fileName = $_FILES['Filename']['name'];
// $link = mysqli_connect("db.cs.dal.ca","abhi","B00775713","abhi") or die("Error ".mysqli_error($link));

$servername = "cloud-a3.cnuacuuti7fl.us-east-2.rds.amazonaws.com";
$username = "vamshi";
$password = "599-5Me-SSV-7SU";
$dbname = "prepMe";

$link = mysqli_connect($servername, $username, $password, $dbname);

/*
*	Checking whether the file already exists in the destination folder
*/
$query = "SELECT filename FROM TopicDetails WHERE filename='$fileName'";
$result = $link->query($query) or die("Error : ".mysqli_error($link));
while ($row = mysqli_fetch_array($result)) {
    if ($row['filename'] == $fileName) {
        $fileExistsFlag = 1;
    }
}
/*
* 	If file is not present in the destination folder
*/
if ($fileExistsFlag == 0) {
    $target = "topics/";
    $fileTarget = $target.$fileName;
    $tempFileName = $_FILES["Filename"]["tmp_name"];
    $fileDescription = $_POST['Description'];
    $topicName = $_POST['TopicName'];
    echo $topicName;
    $result = move_uploaded_file($tempFileName, $fileTarget);
    /*
    *	If file was successfully uploaded in the destination folder
    */
    if ($result) {
        echo "Your file <html><b><i>".$fileName."</i></b></html> has been successfully uploaded";
        $query = "INSERT INTO TopicDetails(topic,filepath,filename,description) VALUES ('$topicName','$fileTarget','$fileName','$fileDescription')";
        $link->query($query) or die("Error : ".mysqli_error($link));
    } else {
        echo "Sorry !!! There was an error in uploading your file";
    }
    mysqli_close($link);
    header("location: populateTopicNames.php");
}
/*
* 	If file is already present in the destination folder
*/
else {
    echo "File <html><b><i>".$fileName."</i></b></html> already exists in your folder.";
    mysqli_close($link);
}

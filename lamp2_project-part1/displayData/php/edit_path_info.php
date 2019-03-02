<?php

$pathID = $_POST['pathNote'];
$pathName = $_POST['pathName'];
$fileID = $_POST['fileID'];
$pathLength = $_POST['pathLength'];
$pathDescri = $_POST['pathDescri'];
$pathNote = $_POST['pathNote'];

$servername = "localhost";
$username = "haiyun";
$password = "1234";

// Create connection
$conn = new mysqli($servername, $username, $password, 'microwave_info');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "UPDATE path_info SET fileID='$fileID', path_length='$pathLength', descrip='$pathDescri', note='$pathNote' WHERE pathID='$pathID';";

$res =$conn->query($qry);

    
    if ($conn->query($sql) === TRUE) {
        echo 1;
    } else {
        echo 0;
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
?>

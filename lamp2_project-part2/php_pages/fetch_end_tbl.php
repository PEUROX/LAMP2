<?php
if(isset($_POST['fileID'])){
    $fileID=$_POST['fileID'];
}

$servername = "localhost";
$username = "haiyun";
$password = "1234";

// Create connection
$conn = new mysqli($servername, $username, $password, "microwave_info");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT * FROM end_point_info WHERE fileID = '$fileID'";

$result = $conn->query($sql);

$row = mysqli_fetch_array($result);

$data =json_encode($row);

echo $data;
?>
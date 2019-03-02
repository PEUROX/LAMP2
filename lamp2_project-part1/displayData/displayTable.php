<?php
$id=$_GET['id'];

$servername = "localhost";
$username = "haiyun";
$password = "1234";

// Create connection
$conn = new mysqli($servername, $username, $password, 'microwave_info');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//$qry="SELECT * FROM person p INNER JOIN shirt s ON s.owner = p.id WHERE p.id ='$id';";

//path_info table

//$qry1="SELECT * FROM path_info WHERE fileID ='$id';";

$qry1="SELECT * FROM path_info t1 inner join end_point_info t2 on t1.fileID = t2.fileID inner join main_data_info t3 on t1.fileID = t3.fileID where t1.fileID ='$id';";

$res1 =$conn->query($qry1);


$row1=mysqli_fetch_all($res1,MYSQLI_ASSOC);

$json1=json_encode($row1);

    echo $json1;

// foreach($row as $k){
//     $json=json_encode($k);
//     echo $json;
//     // echo "style: ".$k[style]."color: ".$k[color]."<br>";
// }



 ?>
<?php
include '$conn.php';

$fileID= $_POST['end_fileID'];
$end_distance= $_POST['end_distance'];
$end_grd_ht= $_POST['end_grd_ht'];
$end_atn_ht= $_POST['end_atn_ht'];

$sql = "UPDATE end_point_info SET end_ground_height='$end_grd_ht',  end_antenna_height = '$end_atn_ht' WHERE pointID='$fileID'";

if ($conn->query($sql) === TRUE) {
    echo 1;
} else {
    echo 0;
}

$conn->close();



?>

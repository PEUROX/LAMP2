<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>drop down</title>
  <style>
      table, th, tr, td{
          border:solid 1px black;
          border-collapse:collapse;
      }

      th, td{
          width:120px;
          text-align:center;
      }
  </style>
</head>
<body>


</div>
<?php

$servername = "localhost";
$username = "haiyun";
$password = "1234";

// Create connection
$conn = new mysqli($servername, $username, $password, 'microwave_info');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$qry="select * from path_info";

$res =$conn->query($qry);

$row=mysqli_fetch_all($res,MYSQLI_ASSOC);

?>

<select id="sel" onchange="getName(this.value)">
<?php

 foreach ($row as $v){

echo "<option value=".$v['fileID'].">".$v['path_name']."</option>";

 };

 mysqli_close($conn);
?>

</select>




<br>
<br>

<div id="path_info"></div>
<div id="end_point_info"></div>
<div id="main_data_info"></div>

<script src="ajax.js"></script>

</body>
</html>
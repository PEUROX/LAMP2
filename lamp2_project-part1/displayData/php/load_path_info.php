<?php
$pathID= $_GET['path_id'];


$servername = "localhost";
$username = "haiyun";
$password = "1234";

// Create connection
$conn = new mysqli($servername, $username, $password, 'microwave_info');

// Check connection
if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);
} 

$qry="SELECT * FROM path_info WHERE fileID  ='$pathID';";

$res =$conn->query($qry);


$row=mysqli_fetch_assoc($res);


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Path Info</title>

    <h3>Edit Path Info</h3>
    <form id="form_edit_path" method="post">
    <label>Path ID</label>
    <input type="text" id='pathID' name ='pathID' value="<?php echo $row['pathID']?>" disabled> <br>
    <label>Path Name</label>
    <input type="text" id="pathName" name ="pathName" value="<?php echo $row['path_name']?>" disabled><br>
    <label>File ID</label>
    <input type="text" id='fileID' name ='fileID' value="<?php echo $row['fileID']?>"> <br>
    <label>Path Length</label>
    <input type="text" id="pathLength" name ="pathLength" value="<?php echo $row['path_length']?>"><br>
    <label>Description</label>
    <input type="text" id="pathDescri" name="pathDescri" value="<?php echo $row['descrip']?>"><br>
    <label>Note</label>
    <input type="text" id="pathNote" name="pathNote" value="<?php echo $row['note']?>"><br>

    </form>
    
    <button id='pathBtn' value='Submit Edit'>Submit Edit</button>
    
</head>
<body>

<script src="../JS/jquery-3.3.1.js"></script>

<script>
    var frm = $('#form_edit_path');
    

    $('#pathBtn').click(function (e) {

        e.preventDefault();

        $.ajax({
            type: frm.attr('method'),
            url: 'edit_path_info.php',
            data: frm.serialize(),
            success: function (data) {
                if (data=='1'){
                alert('Submission was successful.');
                window.location.href = "../dropdown.php";
              }
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            },
        });
    });


</body>
</html>
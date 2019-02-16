<?php
  session_start();
?>
<html>
  <head>
    <title>Upload the CSV file</title>
  </head>

  <body>
    <h1>Click upload to uplaod a CSV file</h1>
    <form method = "POST" enctype = "multipart/form-data">

    <input type = "hidden" name = "MAX_FILE_SIZE" value = "1000000"/>
    <label for = "the_file">Upload CSV File:</label>

    <input type = "file" name = "the_file" id = "the_file"  value="<?php echo isset($_POST["upload_file"]) ? $_FILES['the_file']['tmp_name'] : ''; ?>"/></br></br>

    <input type = "submit" name = "upload_file" value = "Save CSV"/></br></br>
    </body>
</html>
 <?php
 $err_message = array();

       if (isset($_POST['upload_file'])){
            
            if($_FILES['the_file']['error'] > 0){
                echo $err_message = "<p style = 'color:red;'>You have not uploaded any CSV !</p></br>"; 
            }else{
                $_SESSION['csv'] = $_FILES['the_file'];
            }
      
       if (!empty($err_message)){
         exit;
       }             

       if (empty($err_message)){
           //header("location: http://localhost/lab5/summary.php");
          echo ".";
       }
 
       }
    ?>

<?php
if($_FILES){

  if ($_FILES['the_file']['error'] > 0){
      echo '<p style = "color:red;">Following errors occured in uploading the CSV:</p>';

      switch($_FILES['the_file']['error'])
      {
        case 1:
        echo "<p style = 'color:red;'>File excceds the max upload size</p></br>";
        break;
        
        case 2:
        echo "<p style = 'color:red;'>File excceds the max upload size</p></br>";
        break;

        case 3:
        echo "<p style = 'color:red;'>File not uploaded properly</p></br>";
        break;

        case 4:
        echo "<p style = 'color:red;'>No CSV uploaded</p></br>";
        break;

        case 5:
        echo "<p style = 'color:red;'>Directory not specified properly</p></br>";
        break;

        case 6:
        echo "<p style = 'color:red;'>No temporary directory specified</p></br>";
        break;

        case 7:
        echo "<p style = 'color:red;'>Cannot write to disk : UPLOAD FAILED!</p></br>";
        break;
       
        case 8;
        echo "<p style = 'color:red;'>File upload was blocked</p></br>";
        break;
      }

exit;
  }

  $acceptedExt = array('csv');
$ext = strtolower(pathinfo($_FILES['the_file']['name'], PATHINFO_EXTENSION));

if (!in_array($ext, $acceptedExt)){
  echo "<p style = 'color:red;'>ERROR : Files with only csv format can be uploaded.</p>";
  exit;
}


$uploaded_csv = '/var/www/html/lamp2_project1/uploads/'. $_FILES['the_file']['name'];

if (is_uploaded_file($_FILES['the_file']['tmp_name'])){
  if (!move_uploaded_file($_FILES['the_file']['tmp_name'],$uploaded_csv)){
     echo "<p style = 'color:red;'>Could not move file to the destination directory</p>";
     exit; 
  }
}else{
  echo "Cannot upload the file:</br>";
  echo $_FILES['the_file']['name'];
  exit;
}


echo "<p style = 'color:green'>Successfully uploaded the file</p></br>";


$csvfile = file($uploaded_csv);


   foreach($csvfile as $n){
       $csv_arr[] = explode(',',$n);
   }    

  $GLOBALS['var'] = $csv_arr;

  save_data2();
  save_data();

 //(select fileID from csv_file WHERE file_name =".$_FILES['the_file']['name']."),"
 
}
function save_data(){
  
    @$db = new mysqli('localhost','part1user','Test123','microwave_info');
    
    
        if (mysqli_connect_errno()){
            echo "<p style = 'color:red;'>Error: could not connect to the database<br/>
            Please try again later</p>";
        }  
    
        //print_r ($GLOBALS['var']);
           echo "<table border=\"1\">\n";
   echo "<tr><th>Ditsance from start end point</th><th>Ground Height</th><th>Terrain Type</th><th>Obstruction height</th><th>Obstruction type</th></tr>";
 foreach($GLOBALS['var'] as $out){
          for($u = 0; $u < 5 ; $u++){
            if(!isset($out[$u])){
              $out[$u] = "";
            }
          }
       echo "<tr><td>". $out[0] ."</td><td>". $out[1] ."</td><td>". $out[2] ."</td><td>". $out[3] ."</td><td>". $out[4] ."</td></tr>";
       $query = "INSERT INTO path_data (pathFile,distSpEp,groundHeight,terrainType,obstructionHeight,obstructionType) VALUES ((select fileID from csv_file where file_name = '".$_FILES['the_file']['name']."'),'".$out[0]."','".$out[1]."','".$out[2]."','".$out[3]."','".$out[4]."');";


       if ($db->query($query) === TRUE) {
       // echo "New record created successfully";
    } else {
       // echo "Error: " . "<p style = 'color:red';>" .$query . "</p><br>" . $db->error;
    }
 } 
 

        //$query = "INSERT INTO csv_file (file_name) VALUES ('".mysqli_real_escape_string($db,$_FILES['the_file']['name'])."');";
       
    
    
    $db->close();
    }


    function save_data2(){
  
      @$db = new mysqli('localhost','part1user','Test123','microwave_info');
      
      
          if (mysqli_connect_errno()){
              echo "<p style = 'color:red;'>Error: could not connect to the database<br/>
              Please try again later</p>";
          }  
      
    $query = "INSERT INTO csv_file (file_name) VALUES ('".mysqli_real_escape_string($db,$_FILES['the_file']['name'])."');";
         
      
         if ($db->query($query) === TRUE) {
         // echo "New record created successfully";
      } else {
          //echo "Error: " . $query . "<br>" . $db->error;
      }
    
  
      $db->close();
      }
  
   

    ?>


  
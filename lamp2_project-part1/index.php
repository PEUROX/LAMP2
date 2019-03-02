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


$uploaded_csv = './uploads/'. $_FILES['the_file']['name'];

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




/*
  $file = fopen($uploaded_csv,"r");

  $col_array = [];

  while(! feof($file))
  {
    $csv_data =fgetcsv($file);

  $col_array[] = $csv_data;
  }
  $line1_array = $col_array[0];
  $col_count1 = count($line1_array);
  //echo($col_count);

  $line2_array = $col_array[1];
  $col_count2 =count($line2_array);

  $line3_array = $col_array[2];
  $col_count3 = count($line3_array);

  $num = count($col_array);

  $line4_array = [];

  for($i = 3; $i < $num; $i++){

  $line4_array = $col_array[$i];
  
  $count4_array = count($line4_array);

  $lineon_array[] = $line4_array;
  }

fclose($file);
*/

$db = new mysqli('localhost','haiyun','1234','microwave_info');
      
      
  if (mysqli_connect_errno()){
      echo "<p style = 'color:red;'>Error: could not connect to the database<br/>
      Please try again later</p>";
  } 

  $pk = save_file_name($db);

// if filename  successfully inserted then proceed 
/*if ($pk >0 ) {
$row = 1;
if (($handle = fopen($uploaded_csv  , "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
       
        
        // save csv data to respectieve tables  $row determines which table is inserted 
   $valid =  saveLinetoDB( $db ,$pk ,$row, $data);
        
         $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
}



}*/

  /*kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk */

$row = 1;
if (($handle = fopen($uploaded_csv, "r")) !== FALSE) {
    while (($csv_data = fgetcsv($handle, 1000, ",")) !== FALSE) {
     
        $error = "";
       
      
        $col_count= count($csv_data);

       

        if($col_count == 4){
         
        
            if (!is_string($csv_data[0])|| strlen($csv_data[0])>100 || !isset($csv_data[0])) 
            {$error = "Wrong data type";echo $error;
              delete_wrong_file($db,$pk);
              exit;};
            if (!is_string($csv_data[1])|| strlen($csv_data[1])>100 || !isset($csv_data[0])) 
            {$error = "Wrong data type";echo $error;
              delete_wrong_file($db,$pk);
              exit;};
            if (!is_string($csv_data[2])|| strlen($csv_data[2])>100 || !isset($csv_data[0]))
             {$error = "Wrong data type";echo $error;exit;};
            if (!is_string($csv_data[3])|| strlen($csv_data[3])>100) {$error = "Wrong data type";echo $error;
              delete_wrong_file($db,$pk);
              exit;};

            $line1_array[] = $csv_data;

            $valid =  saveLinetoDB( $db ,$pk ,$row, $csv_data);

        }

        if($col_count == 3){
          echo $col_count;
          if(!is_numeric($csv_data[0])) {$error = "Wrong data type";echo $error;exit;};
          if(!is_numeric($csv_data[1])) {$error = "Wrong data type";echo $error;exit;};
          if(!is_numeric($csv_data[2])) {$error = "Wrong data type";echo $error;exit;};

          $line2n3_array[] = $csv_data;
         
          $valid =  saveLinetoDB( $db ,$pk ,$row, $csv_data);
          
        }

        if($col_count == 5){
         
          if(!is_numeric($csv_data[0])){$error = "Wrong data type"; echo $error;exit;};
          if(!is_numeric($csv_data[1])) {$error = "Wrong data type"; echo $error;exit;};
          if(!is_string($csv_data[2]) || strlen($csv_data[2]) > 100){$error = "Wrong data type"; echo $error;exit;};
          if(!is_numeric($csv_data[3])) {$error = "Wrong data type";echo $error;exit;};
          if(!is_string($csv_data[4])) {$error = "Wrong data type";echo $error;exit;
          };   

          $line4_array[] = $csv_data;
          $valid =  saveLinetoDB( $db ,$pk ,$row, $csv_data);
        }

        $row++;

    }
    
    

  
    fclose($handle);
} 

}

function save_file_name($db)
{
 

$query = "INSERT INTO file_info (file_name) VALUES ('".mysqli_real_escape_string($db,$_FILES['the_file']['name'])."');";
 

 if ($db->query($query) === TRUE) {
  $file_primary_id  = mysqli_insert_id($db);
}

//$db->close();
return $file_primary_id;

}   

function saveLinetoDB($db , $pk ,$row, $data)
{
   $valid = 0;
     echo $row;
   // save the header data
   if ($row==1) {
      
     //validate_PathInfo($data);
     
     $query = "INSERT INTO path_info (fileID,path_name,path_length,descrip,note) 
        VALUES (" .$pk.", '".$db->real_escape_string($data[0])."',
         ".$data[1].",'".$db->real_escape_string($data[2])."',
            '".$db->real_escape_string($data[3])."');";       
 
     echo $query;
       
      if ($db->query($query) !== TRUE) {
          $valid =1;
      }    
     

     
    }
   else if ($row ==2 ) {

       // validate_begin_point_info($data);
     
     $query = "INSERT INTO begin_point_info (fileID,point1,point2,point3) 
        VALUES (" .$pk.", ".$data[0].",
         ".$data[1].",".$data[2]."
            );";       
 
       
     


      if ($db->query($query) !== TRUE) {
          $valid =1;
      }    
     
      echo $query;
   }
    else if ($row ==3) {
     
    //  validate_end_point_info($data);
     
     $query = "INSERT INTO end_point_info (fileID,point1,point2,point3) 
        VALUES (" .$pk.", ".$data[0].",
         ".$data[1].",".$data[2]."
            );";       
 
       
     


      if ($db->query($query) !== TRUE) {
          $valid =1;
      }    
     echo $query;
   }
   
   else if ($row > 3 ) {
    
       // validate_main_data_info($data);
     
     $query = "INSERT INTO main_data_info (fileID,distance,ground_height,terrain_type,obstruction_height,obstruction_type) 
        VALUES (" .$pk.", ".$data[0].",
         ".$data[1].",'".$db->real_escape_string($data[2])."',
            ".$data[3].",'".$db->real_escape_string($data[4])."');";       
 
  
      if ($db->query($query) !== TRUE) {
          $valid =1;
      }    
     
    echo $query;
   
    }
      
    return $valid ;

}

function delete_wrong_file($db,$pk){
  $query = "DELETE * FROM file_info WHERE file_name = '".$pk."';";
}


 


    ?>


  
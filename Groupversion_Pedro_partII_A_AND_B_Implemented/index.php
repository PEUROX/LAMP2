<?php
  session_start();
?>
<!DOCTYPE html>
<!--
  ~ Copyright (c) 2019.
  -->

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>CSV Upload</title>

  <!-- Bootstrap -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">WebSiteName</a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="/">Home</a></li>
        <li><a href="/pages/list.html">List</a></li>
      </ul>
    </div>
  </nav>
  <div class="container">
    
    <div id="one">
    <h1>Click choose file to uplaod a CSV file</h1>
    <form method = "POST" enctype = "multipart/form-data">

    <input type = "hidden" name = "MAX_FILE_SIZE" value = "1000000"/>
    <label for = "the_file">Upload CSVaads File:</label>

    <input type = "file" name = "the_file" id = "the_file"  value="<?php echo isset($_POST["upload_file"]) ? $_FILES['the_file']['tmp_name'] : ''; ?>"/></br></br>

    <input type = "submit" name = "upload_file"  value = "Save CSV"/></br></br>
    </form>
   

 <?php


 $err_message = array();

       if (isset($_POST['upload_file'])){
            
            if($_FILES['the_file']['error'] > 0){
                echo $err_message = "<p style = 'color:red;'>You have not uploaded any CSV !</p></br></br></br>"; 
            }else{
                $_SESSION['csv'] = $_FILES['the_file'];
            }
      
       if (!empty($err_message)){
         exit;
       }             

       if (empty($err_message)){
           //header("location: http://localhost/lamp2_project1/displayData/index.php");
         
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

$unique_name = uniqid(rand(), true). $_FILES['the_file']['name'];
$uploaded_csv = './uploads/'. $unique_name;

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




$db = new mysqli('localhost','root','','pedro');
      
      
  if (mysqli_connect_errno()){
      echo "<p style = 'color:red;'>Error: could not connect to the database<br/>
      Please try again later</p>";
  } 

  $success = 0;
  $db->begin_transaction();




  $pk = save_file_name($db,$unique_name);

    if($pk == 0){
      $success = 1;
      $db->rollback();
      unlink($uploaded_csv);
      exit;
    }

  /*kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk */

$row = 1;
if (($handle = fopen($uploaded_csv, "r")) !== FALSE) {
    while (($csv_data = fgetcsv($handle, 1000, ",")) !== FALSE) {
     
        $error = "";
       
      
        $col_count= count($csv_data);

       
        $query = "DELETE  FROM file_info WHERE fileID = '".$pk."';";
        if($col_count == 4){
         
                   $path_col1 = $csv_data[0];

                    

                    $query1 = "select path_name from path_info where path_name ='".$path_col1."';";

                   $rs = $db->query($query1);
                   
                   if($rs->num_rows > 0){
                     $success =1;
                     echo "<p id = 'pp' style  = 'color:red;'>Path already exists !</p></br>";
                     echo "<p id = 'ss' style = 'color:red;'>File already exists !</p></br>";
                     $db->query($query);
                     $db->rollback();
                     unlink($uploaded_csv);
                     exit;
                         echo $val[0];
                   }
                   
                 
                          
            if (!is_string($csv_data[0])|| strlen($csv_data[0])>100 || !isset($csv_data[0])) 
            {$error = "Wrong data type";echo $error;
              $success = 1;
              //delete_wrong_file($db,$pk);
              
              $db->query($query);
              $db->rollback();
              unlink($uploaded_csv);
              exit;};
            if (!is_string($csv_data[1])|| strlen($csv_data[1])>100 || !isset($csv_data[0])) 
            {$error = "Wrong data type";echo $error;
              $success = 1;
              $db->query($query);
              $db->rollbackdata();
      unlink($uploaded_csv);
              exit;};
            if (!is_string($csv_data[2])|| strlen($csv_data[2])>100 || !isset($csv_data[0]))
             {$error = "Wrong data type";echo $error;
              $success = 1;
              $db->query($query);
              $db->rollback();
      unlink($uploaded_csv);
              exit;};
            if (!is_string($csv_data[3])|| strlen($csv_data[3])>100) {$error = "Wrong data type";echo $error;
              $success = 1;
              $db->query($query);
              $db->rollback();
      unlink($uploaded_csv);
              exit;};

            $line1_array[] = $csv_data;

            $valid =  saveLinetoDB( $db ,$pk ,$row, $csv_data);

            if($valid == 1){
              $success = 1;
            }

        }

        if($col_count == 3){
         
          if(!is_numeric($csv_data[0])) {$error = "Wrong data type";echo $error;
            $success = 1;
            $db->query($query);
            $db->rollback();
      unlink($uploaded_csv);
            exit;};
          if(!is_numeric($csv_data[1])) {$error = "Wrong data type";echo $error;
            $success = 1;
            $db->query($query);
            $db->rollback();
      unlink($uploaded_csv);
            exit;};
          if(!is_numeric($csv_data[2])) {$error = "Wrong data type";echo $error;
            $success = 1;
            $db->query($query);
            $db->rollback();
      unlink($uploaded_csv);
            exit;};

          $line2n3_array[] = $csv_data;
         
          
          $valid =  saveLinetoDB( $db ,$pk ,$row, $csv_data);
          
          if($valid == 1){
            $success = 1;
          }
        }

        if($col_count == 5){
         
          if(!is_numeric($csv_data[0])){$error = "Wrong data type"; echo $error;
            $success = 1;
            $db->query($query);
            $db->rollback();
      unlink($uploaded_csv);
            exit;};
          if(!is_numeric($csv_data[1])) {$error = "Wrong data type"; echo $error;
            $success = 1;
            $db->query($query);
            $db->rollback();
      unlink($uploaded_csv);
            exit;};
          if(!is_string($csv_data[2]) || strlen($csv_data[2]) > 100){$error = "Wrong data type"; echo $error;
            $success = 1;
            $db->query($query);
            $db->rollback();
      unlink($uploaded_csv);
            exit;};
          if(!is_numeric($csv_data[3])) {$error = "Wrong data type";echo $error;
            $success = 1;
            $db->query($query);
            $db->rollback();
      unlink($uploaded_csv);
            exit;};
          if(!is_string($csv_data[4])) {$error = "Wrong data type";echo $error;
            $success = 1;
            $db->query($query);
            $db->rollback();
      unlink($uploaded_csv);
            exit;
          };   

          $line4_array[] = $csv_data;
          $valid =  saveLinetoDB( $db ,$pk ,$row, $csv_data);

          if($valid == 1){
            $success = 1;
          }
        }

        $row++;

    }
    
    

  
    fclose($handle);
} 

   if($success == 1){
      
      $db->rollback();
      unlink($uploaded_csv);
   }else{
     $db->commit();
   }

}

function save_file_name($db,$unique_name)
{
 

$query = "INSERT INTO file_info (file_name) VALUES ('".mysqli_real_escape_string($db,$unique_name)."');";
 

 if ($db->query($query) === TRUE) {
  $file_primary_id  = mysqli_insert_id($db);
}

//$db->close();
return $file_primary_id;

}   

function saveLinetoDB($db , $pk ,$row, $data)
{
   $valid = 0;
     //echo $row;
   // save the header data
   if ($row==1) {
      
     //validate_PathInfo($data);
     
     $query = "INSERT INTO path_info (fileID,path_name,path_length,descrip,note) 
        VALUES (" .$pk.", '".$db->real_escape_string($data[0])."',
         ".$data[1].",'".$db->real_escape_string($data[2])."',
            '".$db->real_escape_string($data[3])."');";       
 
     //echo $query;
       
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
     
      //echo $query;
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
    // echo $query;
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
     
    //echo $query;
   
    }
      
    return $valid ;

}

function delete_wrong_file($db,$pk){

  $query = "DELETE  FROM file_info WHERE fileID = '".$pk."';";
  
  echo $query;
  if ($db->query($query) !== TRUE) {
    
}    
}
 
    ?>

  
       
<div id = "footer"><p id = "des">Microwave Communication System</p></div>


</div>
</div>


     
<?php

    include_once 'php_pages/edit_end_path.php';

?>
    </body>

    </html>


  

<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="css/main.css" type="text/css" rel="stylesheet" >
</head>

<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      <li><a href="edit_list.php">Path Details</a></li>
      <li><a href="curvature_data.php">Curvature Data</a></li>
    </ul>
  </div>
</nav>

<h1>Microwave Radio Path Web Site</h1>

      <?php
         $db = new mysqli('localhost','part1user','Test123!','microwave_info');
      
         $query = "select * from path_info;";
         
        if($db->query($query)==true){
           
         $rs = $db->query($query);
         if($rs->num_rows > 0){
             $rowm=mysqli_fetch_all($rs,MYSQLI_ASSOC);
             
            echo "<label style='margin-left:3%'>Path: <select id='sel' name = 'sel'>";
              echo "<option value = ''>Select a path</option>";

             foreach($rowm as $row){
                
                echo "<option value = ".$row['fileID'].">".$row['path_name']."</option>";
             }
           echo  "</select ></label>";

           echo "<label style='margin-left:30px'>Curvature: <select id='sel_curvature'>
                   <option value=''>Select a Curvature</option>
                   <option value='4/3'>Curvature of 4/3</option>
                   <option value='1'>Curvature of 1</option>
                   <option value='2/3'>Curvature of 2/3</option>
                   <option value='zero'>Curvature of Infinity</option>
                 </select></label>";
           
         }
        }else{
            echo $db->error;
        }
      ?>
      
       <div id = "curvature" style="height:700px"></div>

       <script src ="js/jquery-3.3.1.js"></script>
       <script src="js/curvature_data.js"></script>
<?php

   // include_once 'php_pages/edit_end_path.php';

?>
<div id = "footer"><p id = "des">Microwave Communication System</p></div>

</body>
</html>

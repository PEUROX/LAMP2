<html>
  <body>
      <script src ="jquery-3.3.1.js"></script>
      
      <?php
         $db = new mysqli('localhost','root','','microwave_info');
      
         $query = "select * from path_info;";
         
        if($db->query($query)==true){
           
         $rs = $db->query($query);
         if($rs->num_rows > 0){
             $rowm=mysqli_fetch_all($rs,MYSQLI_ASSOC);
             
            echo "<select id='sel' name = 'sel'>";
              echo "<option value = ''>Select a path</option>";
             foreach($rowm as $row){
                
                echo "<option value = ".$row['fileID'].">".$row['path_name']."</option>";
             }
           echo  "</select>";
         }
        }else{
            echo $db->error;
        }
          
      ?>
      
       <div id = "path_info"></div> 
       <div id = "points_info"></div> 
       <div id = "mid_info"></div> 
      <script src ="ajax.js"></script>
  </body>
    <head>
      
    </head>
</html>
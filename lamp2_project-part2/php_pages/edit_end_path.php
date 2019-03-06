
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit End Path</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  
</head>
<body>

<div class="container">
  
  <!-- Modal -->
  <div class="modal fade" id="edit_end" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit End Path</h4>
        </div>
        <div class="modal-body">
          <form id ='frm_end' action="">
          <table id="tbl_end" >
          <tr><td><label>Path ID</label></td>
            <td><input id="end_fileID" name="end_fileID" type="number" readonly></td>
            <td><span></span></td>
          </tr>
          <tr><td><label>Distance</label></td>
              <td><input id="end_distance" name="end_distance" type="number" readonly></td>
              <td><span></span></td>
          </tr>

          <tr><td><label>Ground Height </label></td>
            <td><input id="end_grd_ht" name="end_grd_ht" type="number" ></td>
            <td><span></span></td>
          </tr>

          <tr><td><label>Antenna Height</label></td>
            <td><input id="end_atn_ht" name="end_atn_ht" type="number"></td>
            <td><span></span></td>
          </tr>

          </table>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="btn_sbmt" class="btn btn-default" data-dismiss="modal">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
        </div>
      </div>
      
    </div>
  </div>

  <div class="modal fade" id="edit_mid" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit End Path</h4>
        </div>
        <div class="modal-body">
          <form action="">
            <label>Mid ID</label>
            <input type="text"><span></span><br>
            
            <label>Mid Distance</label>
            <input type="text"><span></span><br>

            <label>Mid Ground Height </label>
            <input type="text"><span></span><br>

            <label>Mid Obstruction Height</label>
            <input type="text"><span></span><br>

            <label>Mid Terrain Type</label>
            <input type="text"><span></span><br>

            <label>Mid Obstruction Type</label>
            <input type="text"><span></span><br>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
<script src="js/fetch_data_to_display.js"></script>
</body>
</html>



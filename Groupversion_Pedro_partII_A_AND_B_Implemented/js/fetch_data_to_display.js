$("#sel").change(function(){
    contentType:'application/json; charset=utf-8'
    var sPath = $(this).children("option:selected").val();
    //alert(sPath);
    var data = $(this).serializeArray();
   
    $.post("php_pages/data.php",data,onSelect);
});

function onSelect(resp){
      // console.log(resp);
    var res = resp.posts;  
    var response = resp.posts.length;
    if(response > 0){
         
        $("#path_info").html("<h3>Path Info</h3><table id = 'path' border = 1><tr><th>path_name</th><th>path_length</th><th>description</th><th>note</th></tr>");
        $("#points_info").html("<h3>End Point Info</h3><table id = 'points' border = 1><tr><th>Distance</th><th>Ground Height</th><th>Antenna Height</th><th>Edit</th></tr>");
        $("#mid_info").html("<h3>Main Data Info</h3><table id = 'mid' border = 1><tr><th>Distance</th><th>Gound Height</th><th>Terrain Type</th><th>Obstruction Height</th><th>Obstruction Type</th><th>Edit</th></tr>");
        
            $("#path").append("<tr><td>"+res[0].path_name+"</td><td>"+res[0].path_length +"</td><td>"+res[0].descrip+"</td><td>"+res[0].note+"</tr>");
            $("#points").append("<tr><td>"+res[0].point1 +"</td><td>"+res[0].point2 +"</td><td>"+res[0].point3+"</td><td> <button  id='btn_end' class='btn btn-success' data-toggle='modal' data-target='#edit_end' onclick='sendID("+res[0].pointID+")' >Edit</button></td></tr>");
    };
    
    var len=res.length;
    
    for(var i = 0; i < len; i++){
        $("#mid").append("<tr><td>"+res[i].distance+"</td><td>"+res[i].ground_height+"</td><td>"+res[i].terrain_type+"</td><td>"+res[i].obstruction_height+"</td><td>"+res[i].obstruction_type+"</td><td> <button  class='btn btn-success' data-toggle='modal' data-target='#edit_mid'>Edit</button></td></tr>");
    }

};



function sendID(id){


$.ajax({
            type: "POST",
            url: "php_pages/fetch_end_tbl.php",
            data: {
                fileID: id
            },
            success: function (data) {
                console.log(data);
                var res =JSON.parse(data);

               $("#end_fileID").val(res.fileID);
               $("#end_distance").val(res.point1);
               $("#end_grd_ht").val(res.point2);
               $("#end_atn_ht").val(res.point3);
                
            },
            error: function () {
             alert('Error');
            }
        });
}

$("#btn_sbmt").click(function(e){
    
    e.preventDefault();
    $.ajax({
        url: 'php_pages/update_end_tbl.php',
        type: 'post',
        //dataType: 'json',
        data: $('#frm_end').serialize(),
        success: function(data) {
            if (data !== '1'){
    
            $("#err").css('color', 'red')
                     .html(data);
            }else{

                $("#err").css('color', 'green')
                         .html('data saved successfully!');

                $("#edit_end").delay(1000).hide(500, function(){
                    location.reload();
                });
               }

                $('#edit_end').on('hidden.bs.modal', function () {
                    $("#err").html('');
                });
        }
    });
    
})



// $("#btn_sbmt").click(function(e){
//     e.preventDefault();
//     $.ajax({
//         url: 'php_pages/update_end_tbl.php',
//         type: 'post',
//         dataType: 'json',
//         data: $('#frm_end').serialize(),
//         success: function(data) {
//                    if(data==1){
//                        alert('End path info updated successfully!');
//                    }else{
//                        alert('failed to update end path!');
//                    }
//                  }
//     });
    
// })

// $('#edit_end').on('hidden.bs.modal', function () {

//   location.reload();
// });

 $("#tbl_end tr td").css('text-align','left')
//                     .css('border', '1px solid');
       
$("#tbl_end tr td:first-child").width(140).css('background-color','white');
$('input[type=number]').width(70);
$("#tbl_end tr td:nth-child(2)").width(80).css('text-align','center');
$("#tbl_end tr td:nth-child(3)").css('background-color','white');
$(".modal-body").offset({ top: 10, left: 70 });
$("#err").offset({ top: 0, left: 90 });



$.get("php_pages/data.php",onSelect);
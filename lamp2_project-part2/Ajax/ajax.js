$("#sel").change(function(){
    contentType:'application/json; charset=utf-8'
    var sPath = $(this).children("option:selected").val();
    //alert(sPath);
    var data = $(this).serializeArray();
   
    $.post('data.php',data,onSelect);
});

function onSelect(resp){
       console.log(resp.posts[0].path_name);
    var res = resp.posts;  
    var response = resp.posts.length;
    if(response > 0){
         
        $("#path_info").html("<h3>Path Info</h3><table id = 'path' border = 1><tr><th>path_name</th><th>path_length</th><th>description</th><th>note</th></tr>");
        //$("#path").html("<tr><td>"+res[0].path_name+"</td><td>"+res[0].path_length +"</td><td>"+res[0].descrip+"</td><td>"+res[0].note+"</td></tr>");
        $("#points_info").html("<h3>End Point Info</h3><table id = 'points' border = 1><tr><th>Point 1</th><th>Point 2</th><th>Point 3</th></tr>");
        $("#mid_info").html("<h3>Main Data Info</h3><table id = 'mid' border = 1><tr><th>Distance</th><th>Gound Height</th><th>Terrain Type</th><th>Obstruction Height</th><th>Obstruction Type</th></tr>");
        
            $("#path").append("<tr><td>"+res[0].path_name+"</td><td>"+res[0].path_length +"</td><td>"+res[0].descrip+"</td><td>"+res[0].note+"</td></tr>");
            $("#points").append("<tr><td>"+res[0].point1 +"</td><td>"+res[0].point2+"</td><td>"+res[0].point3+"</td></tr>");
    };
    
    var len=res.length;
    
    for(var i = 0; i < len; i++){
        $("#mid").append("<tr><td>"+res[i].distance+"</td><td>"+res[i].ground_height+"</td><td>"+res[i].terrain_type+"</td><td>"+res[i].obstruction_height+"</td><td>"+res[i].obstruction_type+"</td></tr>");
    }
};

$.get('data.php',onSelect);
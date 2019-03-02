//var sel = document.getElementById('sel').value;
 function getName(val){
    
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange =function(){
        if (xhr.readyState=='4'){

        var res = JSON.parse(xhr.responseText);

        console.log(res);

        var str_path_info="<h3>Path Info</h3><table><tr><th>path_name</th><th>path_length</th><th>description</th><th>note</th><th>Edit</th></tr><tr><td>"+res[0].path_name+"</td><td>"+res[0].path_length +"</td><td>"+res[0].descrip+"</td><td>"+res[0].note+"</td>";
        str_path_info+="<td><a href='php/load_path_info.php?path_id="+res[0].pathID+"'>Edit</a></td></tr></table>";
        document.getElementById('path_info').innerHTML=str_path_info;

        var str_end_point_info ="<h3>End Point Info</h3><table><tr><th>Point ID</th><th>Point 1</th><th>Point 2</th><th>Point 3</th><th>Edit</th></tr><tr><td>"+res[0].pointID+"</td><td>"+res[0].point1 +"</td><td>"+res[0].point2+"</td><td>"+res[0].point3+"</td>";
        str_end_point_info+="<td><a href='#'>Edit</a></td></tr></table>";
        document.getElementById('end_point_info').innerHTML=str_end_point_info;

        
        var str_main_data_info="<h3>Main Data Info</h3><table><tr><th>Data ID</th><th>Distance</th><th>Gound Height</th><th>Terrain Type</th><th>Obstruction Height</th><th>Obstruction Type</th><th>Edit</th></tr>";
          var len=res.length;

          for (i=0; i<len; i++){
            
            str_main_data_info+="<tr><td>"+res[i].dataID+"</td><td>"+res[i].distance+"</td><td>"+res[i].ground_height+"</td><td>"+res[i].terrain_type+"</td><td>"+res[i].obstruction_height+"</td><td>"+res[i].obstruction_type+"</td><td><a href='#'>Edit</a></td></tr>";

            
          }

          str_main_data_info+="</table>";
          document.getElementById('main_data_info').innerHTML=str_main_data_info;
        }
    }

    xhr.open('get',"displayTable.php?id="+val);
    xhr.send();
}

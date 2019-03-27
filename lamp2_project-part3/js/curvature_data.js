$("#sel").change(function(){
    var path = $("#sel").val();
    var cur =$("#sel_curvature").val();
    $("#curvature").html('');
    $.post("php_pages/curvature_cal.php",{'pathid':path, 'curv':cur},onSelect);
});

function onSelect(resp){

    var val = JSON.parse(resp);

    if(val.err){
         $("#curvature").html('<h4>'+val.err+'</h4>').css('color','red');
    }else{
        var len = val.length;

        var str;
        str+= "<table>";
        str+="<tr><th>Distance from Start End Point</th><th>Ground Height</th><th>Terrain Type</th><th>Obstruction Height</th><th>Obstruction Type</th><th>Curvature Height</th><th>Apparent and Obstruction Height</th><th>1st Freznel Zone</th><th>Total Clearance Height</th></tr>";

        for(i=0; i<len; i++){

            str+="<tr>";
            str+="<td>"+val[i].d1+"</td>";
            str+="<td>"+val[i].grd_ht+"</td>";
            str+="<td>"+val[i].tr_tp+"</td>";
            str+="<td>"+val[i].obs_ht+"</td>";
            str+="<td>"+val[i].obs_tp+"</td>";
            str+="<td>"+val[i].h+"</td>";
            str+="<td>"+val[i].apt+"</td>";
            str+="<td>"+val[i].f1+"</td>";
            str+="<td>"+val[i].clr+"</td>";
            str+="</tr>";

        }

        str+= "</table>";

        $("#curvature").html(str);

        $('table th').css('border','solid 1px black');
        $('table td').css('border','solid 1px black');
    }
};


$("#sel_curvature").change(function(){
    var path = $("#sel").val();
    var cur =$("#sel_curvature").val();
     $("#curvature").html('');
     $.post("php_pages/curvature_cal.php",{'pathid':path, 'curv':cur},
     function(res){

        var val = JSON.parse(res);
        if(val.err){
           $("#curvature").html('<h4>'+val.err+'</h4>').css('color','red');
        }else{
            var len = val.length;

            var str;
            str+= "<table>";
            str+="<tr><th>Distance from Start End Point</th><th>Ground Height</th><th>Terrain Type</th><th>Obstruction Height</th><th>Obstruction Type</th><th>Curvature Height</th><th>Apparent and Obstruction Height</th><th>1st Freznel Zone</th><th>Total Clearance Height</th></tr>";

            for(i=0; i<len; i++){

                str+="<tr>";
                str+="<td>"+val[i].d1+"</td>";
                str+="<td>"+val[i].grd_ht+"</td>";
                str+="<td>"+val[i].tr_tp+"</td>";
                str+="<td>"+val[i].obs_ht+"</td>";
                str+="<td>"+val[i].obs_tp+"</td>";
                str+="<td>"+val[i].h+"</td>";
                str+="<td>"+val[i].apt+"</td>";
                str+="<td>"+val[i].f1+"</td>";
                str+="<td>"+val[i].clr+"</td>";
                str+="</tr>";

            }

            str+= "</table>";

            $("#curvature").html(str);

            $('table th').css('border','solid 1px black');
            $('table td').css('border','solid 1px black');
        }
     })
  
});
<?php

if(isset($_POST['data1'])) {
    echo $_POST['data1'];
    exit;
}


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="../js/jquery-3.3.1.js"></script>
</head>
<body>

<input type="text" id="txt" name='txt'>
<button id="btn">click</button>


<script>

$("#btn").click(function(e){
    e.preventDefault();
    var val = $("#txt").val();
    $.ajax({
        url:'<?php $_SERVER['PHP_SELF'] ?>',
        type: 'post',
        data: {data1:val},
        success:function(data){
            alert(data);
        }


    })
})
</script>
</body>
</html>


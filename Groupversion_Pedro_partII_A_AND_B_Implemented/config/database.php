<?php

$db = new mysqli('localhost','root','','pedro');

if (mysqli_connect_errno()){
	echo "<p style = 'color:red;'>Error: could not connect to the database<br/>
      Please try again later</p>";
}

$success = 0;

<?php
include("../Config/dbConnection.php");

$queryDb="SELECT filmId, name, year, imdbNote, scoreAverage from films WHERE name like '".$name."%' ORDER BY name ASC";
	
	$query=mysqli_query($connect,$queryDb);
	mysqli_close($connect);

?>
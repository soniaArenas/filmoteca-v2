<?php
include("../Config/dbConnection.php");

$queryDb="SELECT filmId, name, year, imdbNote from films ORDER BY ".$orderBy." ".$order."";
	
	$query=mysqli_query($connect,$queryDb);
	mysqli_close($connect);

?>
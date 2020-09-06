<?php
include("../Config/dbConnection.php");

$queryDb="SELECT * from films WHERE filmId='$id' ";
	
	$query=mysqli_query($connect,$queryDb)or die ("Problemas en el select");
	mysqli_close($connect);

?>
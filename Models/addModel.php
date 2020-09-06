<?php
include("../Config/dbConnection.php");





$resul=$connect->query("SELECT EXISTS (SELECT * FROM films WHERE name='$name' and year='$year');");

$row=mysqli_fetch_row($resul);

if ($row[0]!="1") {       

	$query="INSERT INTO films (name, year, imdbNote, imdbLink ) VALUES ('$name', '$year', '$note', '$link')";

	mysqli_query($connect,$query) or die("Problemas en la consulta".mysqli_error($conexion));
	mysqli_close($connect);
	echo "insertado";
}

?>
<?php
include("../Config/dbConnection.php");

$query="INSERT INTO score (filmId, scoreFilm ) VALUES ('$id', '$score')";

	mysqli_query($connect,$query) or die("Problemas en la consulta");
	
$query2="SELECT scoreFilm from score WHERE filmId='$id'";
$result=mysqli_query($connect,$query2) or die("Problemas en la consulta");
  $row_cnt = mysqli_num_rows($result);
 $totalScore=0.0;
while ($reg=mysqli_fetch_row($result)){
foreach ($reg as $change) {
    $totalScore=$totalScore+$change;
    } 

	}

	$average= $totalScore/ $row_cnt;
	$query3="UPDATE films SET  scoreAverage='$average'
WHERE filmId='$id'";

	mysqli_query($connect,$query3) or die("Problemas en la consulta");
mysqli_close($connect);
?>
<?php

if (isset($_POST["getFilms"])) {

	$orderBy = $_POST['orderBy'];
	$order=$_POST['order'];

	include("../Models/listFilmsModel.php");

	echo " <table class='principalTable'><thead>
	<tr class='headTable'>
	<td>Título</td>
	<td>Año</td>
	<td>Imdb Nota</td>
	</tr></thead><tbody> ";

	$numRow=0;
	$clsRow="";

	while ($reg=mysqli_fetch_row($query)){

		if ($numRow%2==0){

			$clsRow="clsEven";

		}else{

			$clsRow="clsOdd";
		}

		echo "<tr class=".$clsRow."><td class='film' id='film".$reg[0]."'>".ucfirst($reg[1])."</td><td>".ucfirst($reg[2])."</td><td>".ucfirst($reg[3])."</td></tr>";

		$numRow++;
	}
	echo "</tbody></table>";

}else if (isset($_POST["addFilm"])) { 

	$name = $_POST['name'];
	$year = $_POST['year'];
	$note=$_POST['note'];
	$link=$_POST['link'];

	include("../Models/addModel.php");

}else if (isset($_POST["searchFilm"])) { 

	$name = $_POST['name'];

	include("../Models/searchModel.php");

	echo " <table class='principalTable'>
	<tr class='headTable'>
	<td>Título</td>
	<td>Año</td>
	<td>Imdb Nota</td>
	</tr> ";

	$numRow=0;
	$clsRow="";

	while ($reg=mysqli_fetch_row($query)){

		if ($numRow%2==0){

			$clsRow="clsEven";

		}else{

			$clsRow="clsOdd";
		}



		echo "<tr class=".$clsRow."><td class='film' id='film".$reg[0]."'>".ucfirst($reg[1])."</td><td>".ucfirst($reg[2])."</td><td>".ucfirst($reg[3])."</td></tr>";
		$numRow++;
	}
	echo "</table>";

}else if (isset($_POST["searchFilmById"])) { 

	$id = $_POST['id'];

	include("../Models/searchByIdModel.php");

	while ($reg=mysqli_fetch_array($query)){

		echo "<div><img id='closeImg' src='Assets/Img/cancel-icon.png' alt=''>


		<h2 class='titleH'> <img class='ribet'  src='Assets/Img/ribete.png' alt=''>  ".ucfirst($reg[1])."   <img class='ribet' src='Assets/Img/ribete.png' alt=''></h2>

		<table id='descriptionTable'>
		<td><img src='".ucfirst($reg[5])."' alt=''></td>
		<td> 
		<h4 class='noteH'>Nota Imbd: ".ucfirst($reg[3])."</h4>
		<h4 class='descri'>Descripción</h4>
		<p>".ucfirst($reg[6])."</p>
		<h4>Director</h4>
		<p>".ucfirst($reg[7])."</p>
		</td>

		<td>
		<h4>Duración: </h4>
		<p>".ucfirst($reg[8])."</p>
		<h4>Género: </h4>
		<p>".ucfirst($reg[9])."</p>
		<h4>Protagonistas: </h4>
		<p>".ucfirst($reg[10])."</p>
		</td>
		</table>



		</div>";
	}



}else if (isset($_POST["updateFilm"])) { 
	$name=$_POST['name'];
	$year=$_POST['year'];
	$linkImg = $_POST['linkImg'];
	$description = $_POST['infoDescription'];
	$director=$_POST['infoDirector'];
	$duration=$_POST['infoDuration'];
	$genre=$_POST['infoGenre'];
	$stars=$_POST['infoStars'];


	include("../Models/updateModel.php");

}
?>
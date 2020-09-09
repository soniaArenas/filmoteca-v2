<?php 
require_once('filmsController.php');


$fController= new FilmsController();

if (isset($_POST["getFilms"])) {



	$resul=$fController->getList($_POST["orderBy"],$_POST["order"]);
	echo $resul;

}else if (isset($_POST["searchFilm"])) { 

	$resul=$fController->searchFilm($_POST["name"]);
	echo $resul;

}else if (isset($_POST["searchFilmById"])) { 
	$resul=$fController->searchFilmById($_POST['id']);
	echo $resul;

}else if (isset($_POST["addFilm"])) { 

	$resul=$fController->addFilm($_POST['name'], $_POST['year'], $_POST['note'], $_POST['link']);
	echo $resul;

}else if (isset($_POST["updateFilm"])) { 

	$resul=$fController->updateFilm($_POST['name'],$_POST['linkImg'], $_POST['infoDescription'], $_POST['infoDirector'], $_POST['infoDuration'], $_POST['infoGenre'],$_POST['infoStars']);

	echo $resul;

}else if (isset($_POST["voteFilm"])) { 

	$resul=$fController->voteFilm($_POST['id'],$_POST['scoreFilm']);
	echo $resul;

	
}else if (isset($_POST["findFilm"])) {
	$resul=$fController->googleSearch($_POST["findFilm"]);
	echo $resul;
}else if (isset($_POST["linkImdb"])) {
	$resul=$fController->findScore($_POST["linkImdb"]);
	echo $resul;
}else if (isset($_POST["getImg"])) {
	$resul=$fController->getLinkImg($_POST["link"]);
	echo $resul;
}else if (isset($_POST["getDesc"])) { 
	$resul=$fController->getDescription($_POST["linkDes"]);
	echo $resul;

}else if (isset($_POST["getDirect"])) { 
	$resul=$fController->getDirector($_POST["linkDirec"]);
	echo $resul;
}else if (isset($_POST["getDuration"])) { 
	$resul=$fController->getDuration($_POST["linkDura"]);
	echo $resul;
}else if (isset($_POST["getGenre"])) { 
	$resul=$fController->getGenre($_POST["linkgenr"]);
	echo $resul;

}else if (isset($_POST["getStars"])) { 
	$resul=$fController->getStars($_POST["linkStars"]);
	echo $resul;
}



?>
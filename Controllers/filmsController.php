<?php 

require_once('../models/filmsModel.php');
require_once("simple_html_dom.php");


class FilmsController{

	private $fModel;

	function __construct(){
		$this->fModel=new FilmsModel();
	}

	public function getList($orderBy,$order){

		$numRow=0;
		$clsRow="";
		$arrayFilms=$this->fModel->getFilms($orderBy,$order);
		echo " <table class='principalTable'><thead>
		<tr class='headTable'>
		<td>Título</td>
		<td>Año estreno</td>
		<td>Nota Imbd</td>
		<td>Nota Visitantes</td>
		</tr></thead><tbody > ";
		foreach ($arrayFilms as $film) {
			if ($numRow%2==0){

				$clsRow="clsEven";

			}else{

				$clsRow="clsOdd";
			}

			echo "<tr class=".$clsRow."><td class='film' id='film".$film['filmId']."'>".ucfirst($film['name'])."</td><td>".ucfirst($film['year'])."</td><td>".ucfirst($film['imdbNote'])."</td><td>".ucfirst($film['scoreAverage'])."</td></tr>";

			$numRow++;
		}
		echo "</tbody></table>";

	}
	public function searchFilm($name){
		echo " <table class='principalTable'>
		<tr class='headTable'>
		<td>Título</td>
		<td>Año</td>
		<td>Imdb Nota</td>
		</tr> ";

		$numRow=0;
		$clsRow="";
		$arrayFilms=$this->fModel->searchFilm($name);
		foreach ($arrayFilms as $film) {

			if ($numRow%2==0){

				$clsRow="clsEven";

			}else{

				$clsRow="clsOdd";
			}



			echo "<tr class=".$clsRow."><td class='film' id='film".$film['filmId']."'>".ucfirst($film['name'])."</td><td>".ucfirst($film['year'])."</td><td>".ucfirst($film['imdbNote'])."</td><td>".ucfirst($film['scoreAverage'])."</td></tr>";

			$numRow++;
		}
		echo "</table>";


	}

	public function searchFilmById($id){

		$arrayFilms=$this->fModel->getFilmById($id);
		foreach ($arrayFilms as $film) {

			echo "<div><img id='closeNew' class='closeImg' src='Assets/Img/cancel-icon.png' alt=''>



			<h2 class='titleH'> <img class='ribet'  src='Assets/Img/ribete.png' alt=''>  ".ucfirst($film['name'])."   <img class='ribet' src='Assets/Img/ribete.png' alt=''></h2>

			<table id='descriptionTable'>
			<td><img src='".ucfirst($film['img'])."' alt=''></td>
			<td> 
			<h4 class='noteH'>Nota Imbd: ".ucfirst($film['imdbNote'])."</h4>
			<h4 class='noteH'>Nota nuestros visitantes: ".ucfirst($film['scoreAverage'])."</h4>
			<h4 class='descri'>Descripción</h4>
			<p>".ucfirst($film['description'])."</p>
			<h4>Director</h4>
			<p>".ucfirst($film['director'])."</p>
			</td>

			<td>
			<h4>Duración: </h4>
			<p>".ucfirst($film['duration'])."</p>
			<h4>Género: </h4>
			<p>".ucfirst($film['genre'])."</p>
			<h4>Protagonistas: </h4>
			<p>".ucfirst($film['stars'])."</p>
			</td>
			</table>
			<div>
			<h4>Valorar Película</h4>
			<input id='score".$id."' class='inputScore' type='text' placeholder='nota de 1 a 10...'>
			<button class='btn' id='btnScore'>Valorar</button>
			</div>


			</div>";
		}


	}

	public function addFilm($name, $year, $note, $link){
		$resul=$this->fModel->addFilm($name, $year, $note, $link);
		echo $resul;
	}
	public function updateFilm($name,$linkImg, $description, $director, $duration, $genre, $stars){
		$resul=$this->fModel->updateFilm($name,$linkImg, $description, $director, $duration, $genre, $stars);
		echo $resul;
	}

	public function voteFilm($id, $score){
		$resul=$this->fModel->voteFilm($id, $score);
		echo $resul;
	}

	public function translate($text){
		$language_from = 'en';
		$text_to_translate =$text;
		$language_to = 'es';
		$encoded_text = urlencode(strip_tags($text_to_translate));
		$url = 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=' . $language_from . '&tl=' . $language_to . '&dt=t&q=' . $encoded_text;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
		curl_setopt($ch, CURLOPT_USERAGENT, 'AndroidTranslate/5.3.0.RC02.130475354-53000263 5.1 phone TRANSLATE_OPM5_TEST_1');
		$output = curl_exec($ch);
		curl_close($ch);


		$response_a = json_decode($output);


		foreach ($response_a[0] as $text_block) {
			echo $text_block[0] ;
		}
	}


	public function googleSearch($string){
		$resul=$this->fModel->googleSearch($string);
		echo $resul;
		
	}

	public function findScore($link){
		$resul=$this->fModel->findScore($link);
		echo $resul;

	}

	public function getLinkImg($link){

		$resul=$this->fModel->getLinkImg($link);
		echo $resul;
		
	}

	public function getDescription($link){
		$resul=$this->fModel->getDescription($link);
		
		echo $this->translate($resul);

	}

	public function getDirector($link){
		$resul=$this->fModel->getDirector($link);
		echo $resul;
		
	}

	public function getDuration($link){
		$resul=$this->fModel->getDuration($link);
		echo $resul;
		
	}


	public function getGenre($link){
		$resul=$this->fModel->getGenre($link);
		
		echo $this->translate($resul);
		
	}

	public function getStars($link){
		$resul=$this->fModel->getStars($link);
		echo $resul;
		
		
	}

}



?>
<?php 

class FilmsModel{

	private $db;

	private $films;

	public function __construct(){
		require_once("db.php");

		$this->db=Connect::connection();

		$this->films=array();

	}

	public function getFilms($orderBy,$order){

		$query="SELECT filmId, name, year, imdbNote, scoreAverage from films ORDER BY ".$orderBy." ".$order.""; 

		$resul=$this->db->query($query)or die ("Problemas en el select de getFilms()");
		while ($row = $resul->fetch_assoc()) {
			$this->films[]=$row;
		}

		return $this->films;

	}

	public function getFilmById($id){

		$query="SELECT * from films WHERE filmId='$id' ";
		
		$resul=$this->db->query($query)or die ("Problemas en el select de getFilmsById()");
		while ($row = $resul->fetch_assoc()) {
			$this->films[]=$row;
		}

		return $this->films;

	}

	public function searchFilm($name){

		$query="SELECT filmId, name, year, imdbNote, scoreAverage from films WHERE name like '".$name."%' ORDER BY name ASC";
		$resul=$this->db->query($query)or die ("Problemas en el select de searchFilm()");
		while ($row = $resul->fetch_assoc()) {
			$this->films[]=$row;
		}

		return $this->films;

	}

	public function addFilm($name,$year,$note,$link){


		$resul=$this->db->query("SELECT EXISTS (SELECT * FROM films WHERE name='$name' and year='$year');");

		$row=mysqli_fetch_row($resul);

		if ($row[0]!="1") {       

			$query="INSERT INTO films (name, year, imdbNote, imdbLink ) VALUES ('$name', '$year', '$note', '$link')";

			$resul2=$this->db->query($query)or die ("Problemas en el insert");
		}

	}


	public function updateFilm($name, $linkImg, $description, $director, $duration, $genre, $stars){

		$query="UPDATE films SET img='$linkImg', description='$description', director='$director', duration='$duration', genre='$genre', stars='$stars'
		WHERE name='$name'";
		
		$resul=$this->db->query($query)or die ("Problemas en el update");
		

	}


	public function votefilm($id, $score){

		$query="INSERT INTO score (filmId, scoreFilm ) VALUES ('$id', '$score')";

		$resul=$this->db->query($query)or die ("Problemas en el insert al votar");
		
		$query2="SELECT scoreFilm from score WHERE filmId='$id'";

		$resul2=$this->db->query($query2)or die ("Problemas en el select al sacar score");
		$row_cnt = mysqli_num_rows($result2);
		$totalScore=0.0;
		while ($reg=mysqli_fetch_row($result2)){
			foreach ($reg as $change) {
				$totalScore=$totalScore+$change;
			} 

		}

		$average= $totalScore/ $row_cnt;
		$query3="UPDATE films SET  scoreAverage='$average'
		WHERE filmId='$id'";

		$resul3=$this->db->query($query)or die ("Problemas en el update al votar");
		

	}

	public function googleSearch($string){
		$url  = 'http://www.google.com/search?hl=en&tbo=d&site=&source=hp&q='.$string.'&oq='.$string.'';
		$html=file_get_html($url);



		$linkObjs = $html->find('a');
		foreach ($linkObjs as $linkObj) {
			$title = trim($linkObj->plaintext);
			$link  = trim($linkObj->href);


			if (!preg_match('/^https?/', $link) && preg_match('/q=(.+)&amp;sa=/U', $link, $matches) && preg_match('/^https?/', $matches[1])) {
				$link = $matches[1];
			} else if (!preg_match('/^https?/', $link)) { 
				continue;    
			}
			if(strpos($title,'title')){

				return  $link; 
				break;
			}   
		}


	}

	public function findScore($link){
		$htmlImdb=file_get_html($link);


		$linkObjs2 = $htmlImdb->find('span[itemprop=ratingValue]');
		foreach ($linkObjs2 as $linkObj2) {
			$note = trim($linkObj2->plaintext);

			return  $note; 
		} 
	}


	public function getLinkImg($link){
		$htmlImdb=file_get_html($link);

		$linkObjs2 = $htmlImdb->find('.poster a img');

		foreach ($linkObjs2 as $linkObj2) {
			$linkImg  = trim($linkObj2->src);

			return $linkImg; 


		} 
	}


	public function getDescription($link){
		$htmlImdb=file_get_html($link);
		$linkObjs2 = $htmlImdb->find('.summary_text');
		foreach ($linkObjs2 as $linkObj2) {
			$descr  = trim($linkObj2->plaintext);


		} 
		return $descr;
	}


	public function getDirector($link){
		$htmlImdb=file_get_html($link);
		$linkObjs2 = $htmlImdb->find('.credit_summary_item a[href$=_dr]');
		foreach ($linkObjs2 as $linkObj2) {
			$credits  = trim($linkObj2->plaintext);

			return $credits; 
		}
	}

	public function getDuration($link){
		$htmlImdb=file_get_html($link);
		$linkObjs2 = $htmlImdb->find('.subtext time');
		foreach ($linkObjs2 as $linkObj2) {
			$time = trim($linkObj2->plaintext);

			return $time; 
		}  
	}

	public function getGenre($link){
		$htmlImdb=file_get_html($link);
		$linkObjs2 = $htmlImdb->find('.subtext a[href^=/search/title?genres]');
		foreach ($linkObjs2 as $linkObj2) {
			$genre = trim($linkObj2->plaintext);
			return $genre;
		}
	}

	public function getStars($link){
		$htmlImdb=file_get_html($link);
		$linkObjs2 = $htmlImdb->find('a[href*=tt_ov_st_sm]');
		$i=0;
		foreach ($linkObjs2 as $linkObj2) {
			if($i<=2){
				$stars = trim($linkObj2->plaintext);

				return $stars."</br> ";
				$i++; 
			}  
		}
	}

}


?>
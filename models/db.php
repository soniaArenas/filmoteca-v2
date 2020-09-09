<?php

	class Connect{

		public static function connection(){

			try{

				$host="localhost";
				$user="admin";
				$pass="admin";
				$db="filmsdb";

   			  $connect=mysqli_connect($host,$user,$pass,$db);

			}catch(Exception $e ){

				die("problemas en la conexión con la base de datos"+$e);
			}

			return $connect;
		}


	}

 ?>
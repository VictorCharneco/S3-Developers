<?php

class UtilityModel extends Model{

    //THIS CLASS WILL HOLD STATIC FUNCTIONS AND VARIABLES USED BY DIFFERENT MODELS OR CONTROLLERS
    //FOR EXAMPLE, JSON DATA HANDLING FUNCTIONS


//// ----------------------- ////
	public static function getJsonDataUser(){
		$data = file_get_contents(JSON_DATA_PATH_USER);
		return json_decode($data, true);
	}

	public static function saveJsonDataUser($data){
		$newData = json_encode($data, JSON_PRETTY_PRINT);
		file_put_contents(JSON_DATA_PATH_USER, $newData);
	}

    public static function getFilmsData(){
		$data = file_get_contents(JSON_FILMS);
		return json_decode($data, true);
	}

	public static function saveFilmData($data){
		$newData = json_encode($data, JSON_PRETTY_PRINT);
		file_put_contents(JSON_FILMS, $newData);
	}
	public static function getJsonCategory(){
		$data = file_get_contents(JSON_DATA_PATH_CATEGORY);
		return json_decode($data, true);
	}

	public static function saveJsonCategory($data){
		$newData = json_encode($data, JSON_PRETTY_PRINT);
		file_put_contents(JSON_DATA_PATH_CATEGORY, $newData);
	}
    
    
}




?>
<?php

class UtilityModel extends Model{

    //THIS CLASS WILL HOLD STATIC FUNCTIONS AND VARIABLES USED BY DIFFERENT MODELS OR CONTROLLERS
    //FOR EXAMPLE, JSON DATA HANDLING FUNCTIONS


//// ----------------------- ////
	public static function getJsonData(){
		$data = file_get_contents(JSON_DATA_PATH);
		return json_decode($data, true);
	}

	public static function saveJsonData($data){
		$newData = json_encode($data, JSON_PRETTY_PRINT);
		file_put_contents(JSON_DATA_PATH, $newData);
	}

    
    
}




?>
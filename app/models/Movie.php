<?php

class Movie extends Model{

    private int $id;
    private string $name;
    private int $year;
    private string $description;
    private string $url;


    public function __construct($name, $url){
        $this->name = $name;
        $this->url = $url;
    }

    public static function getAllMovies():array{
        $data = UtilityModel::getJsonData();
        $movieData = $data["movie"];
        return $movieData;
    }

    public function addMovie():void{
        $data = UtilityModel::getJsonData();
        $data["movie"][] = ["name" => $this -> name , "description" => $this -> description];
        UtilityModel::saveJsonData($data);
    }

}
?>
<?php

class Movie extends Model{

    private int $id;
    private string $name;
    private int $year;
    private string $description;
    private string $url;


    public function __construct($name, $description){
        $data = UtilityModel::getJsonData();
        if(!empty($data["movie"])){
            $lastMovie = end($data["movie"]);
            $this->id = $lastMovie["id"] + 1;
        }else{
            $this->id = 1;
        }

        $this->name = $name;
        $this->description = $description;
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

    public static function deleteMovie(int $id):void{
        $data = UtilityModel::getJsonData();
        array_splice($data["movie"], $id, 1);
        UtilityModel::saveJsonData(($data));
    }


}
?>
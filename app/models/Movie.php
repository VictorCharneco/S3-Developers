<?php

class Movie extends Model{

    private int $id;
    private string $name;
    private int $year;
    private string $description;
    private string $url;


    public function __construct($name, $description){
        $data = UtilityModel::getFilmsData();
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
        $data = UtilityModel::getFilmsData();
        $movieData = $data["movie"];
        return $movieData;
    }

    public function addMovie():void{
        $data = UtilityModel::getFilmsData();
        $data["movie"][] = ["id" => $this -> id, "name" => $this -> name , "description" => $this -> description];
        UtilityModel::saveFilmData($data);
    }

    public static function deleteMovie(int $id):void{
        $data = UtilityModel::getFilmsData();
        array_splice($data["movie"], $id, 1);
        UtilityModel::saveFilmData(($data));
    }

    public function updateMovie():void{
        $data = UtilityModel::getFilmsData();
        foreach($data["movie"] as &$movie){
            if($movie["id"] === $this -> id){
                $movie["name"] = $this -> name;
                $movie["description"] = $this -> description;
                break;
            }
        }
        UtilityModel::saveFilmData($data);
    }

}
?>
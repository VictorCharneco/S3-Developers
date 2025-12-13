<?php

class Movie extends Model{

    private int $id;
    private string $name;
    private int $year;
    private string $description;
    private string $urlImage;

    private string $trailerUrl;


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
        $this->urlImage = "";
        $this->trailerUrl = "";
    }

    public function setUrlImage(string $urlImage):void{
        $this->urlImage = $urlImage;
    }

    public static function getAllMovies():array{
        $data = UtilityModel::getFilmsData();
        $movieData = $data["movie"];
        return $movieData;
    }

    public function addMovie():void{
        $data = UtilityModel::getFilmsData();
        $newFilm = ["id" => $this -> id, "name" => $this -> name , "description" => $this -> description];
        if ($this-> urlImage){
            $newFilm["urlImage"] = $this -> urlImage;
        }
        if($this->trailerUrl)
            $newFilm["trailer"] = $this -> trailerUrl;

        $data["movie"][] = $newFilm;
        UtilityModel::saveFilmData($data);
    }

    public static function deleteMovie(int $id):void{
        $data = UtilityModel::getFilmsData();
        $usersData = UtilityModel::getJsonDataUser();
        foreach($data["movie"] as $index => $movie){
            if($movie["id"] === $id){
                if(!empty($movie["urlImage"])){
                    $imagePath = ltrim($movie["urlImage"], '/');
                    if(file_exists($imagePath)){
                        unlink($imagePath);
                    }
                }
               foreach ($usersData["users"] as $userIndex => $user) {

                    if (isset($user["films"]) && !empty($user["films"])) {  
                        foreach ($user["films"] as $filmIndex => $filmId) {

                            if ($filmId === $id) {
                                unset($usersData["users"][$userIndex]["films"][$filmIndex]);
                            }
                        }

                            $usersData["users"][$userIndex]["films"] = array_values($usersData["users"][$userIndex]["films"]);
                    }
                }
                array_splice($data["movie"], $index, 1);
                break;
            }
        }
        UtilityModel::saveJsonDataUser($usersData);
        UtilityModel::saveFilmData($data);
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

    public static function getFilmsById(array $idFilms): array{
        if(!empty($idFilms)){
            $films = [];
            $filmsData = UtilityModel::getFilmsData();
           for($i = 0; $i < sizeof($idFilms); $i++){
                foreach($filmsData["movie"] as $film){
                    if($film["id"] === $idFilms[$i]){
                        $films[] = $film;                    
                    }
                }
            }
            return $films;
        }
        return[];
    }

    public function setTrailerUrl(string $url){
        $this -> trailerUrl = $url;
    }

}
?>
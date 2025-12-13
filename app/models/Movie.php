<?php

class Movie extends Model{

    private int $id;
    private string $name;
    private int $year;
    private string $description;
    private string $urlImage;
    private int $categoryId;


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
    }

    public function setCategory(int $categoryId):void{
        $this->categoryId = $categoryId;
    }

    public function setUrlImage(string $urlImage):void{
        $this->urlImage = $urlImage;
    }

    public function getId():int{
        return $this -> id;
    }   

    public static function getAllMovies():array{
        $data = UtilityModel::getFilmsData();
        $movieData = $data["movie"];
        return $movieData;
    }
        
    /**
     * addMovie
     * This function add a new movie to films.json. 
     * If user sets an image, that will be saved too but its not mandtory.
     * @return void
     */
    public function addMovie():void{
        $data = UtilityModel::getFilmsData();
        $newFilm = ["id" => $this -> id, "name" => $this -> name , "description" => $this -> description, "categories" => $this->categoryId];

        if ($this-> urlImage){
            $newFilm["urlImage"] = $this -> urlImage;
        }
        $data["movie"][] = $newFilm;
        UtilityModel::saveFilmData($data);
    }

    /**
     * deleteMovie
     * This function looks for a movie by its ID at films.json and if it founds it, deletes it. 
     * in case the movie has an image, it erases too.
     * @param  mixed $id
     * @return void
     */
    public static function deleteMovie(int $id):void{
        $data = UtilityModel::getFilmsData();
        foreach($data["movie"] as $index => $movie){
            if($movie["id"] === $id){
                if(!empty($movie["urlImage"])){
                    $imagePath = ROOT_PATH . '/web/' . ltrim($movie["urlImage"], '/');
                    if(file_exists($imagePath)){
                        unlink($imagePath);
                    }
                }
                array_splice($data["movie"], $index, 1);
                break;
            }
        }
        UtilityModel::saveFilmData($data);
    }

    
    /**
     * updateMovie
     * this fnciont update the movie 
     * @return void
     */
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
    
    /**
     * addCategoryToFilm
     * This function search by ID the movie and once found it, adds a category to it.
     * @param  mixed $categoryId
     * @return void
     */
    public function addCategoryToFilm(int $categoryId):void{
        if(!UtilityModel::getJsonCategory()){
            return;
        }
        $data = UtilityModel::getFilmsData();
        foreach($data["movie"] as &$movie){
            if($movie["id"] === $this -> id){
                $movie["categories"] = $categoryId;
            }
        }
        UtilityModel::saveFilmData($data);
    }

}
?>
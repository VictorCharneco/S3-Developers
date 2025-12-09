<?php


class AddfilmController extends ApplicationController{
    public $moviesData;

    public function addfilmAction(){

        $this -> moviesData = UtilityModel::getFilmsData();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $name = $_POST["name"];
            $description = $_POST["description"];
            $urlImage = null;
            if(!empty($_FILES["file"]["name"])){
                $dire = "images/filmCovers/";
                $fileName = basename($_FILES["file"]["name"]);
                $filePath = $dire . $fileName;
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)){
                    $urlImage = "/" . $filePath;
            
                }
            }
            $newFilm = new Movie ($name, $description);
            if ($urlImage){
                $newFilm -> setUrlImage($urlImage);
            }
            $newFilm -> addMovie();
            header("Location: /listFilms");
            exit();
        }else{
            $moviesData = Movie::getAllMovies();
        }
    }

    
}


?>
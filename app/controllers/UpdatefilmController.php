<?php

class UpdatefilmController extends ApplicationController{
    public $moviesData;

    public function updatefilmAction(){
        $this -> moviesData = UtilityModel::getFilmsData();
         
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id= (int)$_POST["select-movie"];
            $name = $_POST["name"];
            $description = $_POST["description"];

            $data = UtilityModel::getFilmsData();
            
            foreach($data["movie"] as &$movie){
                if($movie["id"] === $id){
                    $movie["name"] = $name;
                    $movie["description"] = $description;
                    
                    if(!empty($_FILES["file"]["name"])){
                        $dire = "images/filmCovers/";
                        $fileName = basename($_FILES["file"]["name"]);
                        $filePath = $dire . $fileName;
                        if(move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)){
                            $movie["urlImage"] = "/" . $filePath;
                    
                        }
                    }
                    break;
                }
        
            UtilityModel::saveFilmData($data);
            header("Location: /listFilms");
            exit();}
        }else{
            $moviesData = Movie::getAllMovies();
            $this -> view -> moviesData = $moviesData;
        }
    }
}

?>
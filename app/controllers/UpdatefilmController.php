<?php

class UpdatefilmController extends ApplicationController{
    public $moviesData;
    public $categoriesData;

    public function updatefilmAction(){
         
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id= (int)$_POST["select-movie"];
            $name = $_POST["name"];
            $description = $_POST["description"];
            $categoryId = (int)$_POST["categories"];

            $data = UtilityModel::getFilmsData();
            
            foreach($data["movie"] as &$movie){
                if($movie["id"] == $id){
                    $movie["name"] = $name;
                    $movie["description"] = $description;
                    $movie["categories"] = [$categoryId];
                    
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
            }

            UtilityModel::saveFilmData($data);
            header("Location: /listFilms");
            exit();
        }else{
            $this->moviesData = UtilityModel::getFilmsData()["movie"];
            $this->categoriesData = UtilityModel::getJsonCategory()["category"];
            $this -> view -> moviesData = $this -> moviesData;
            $this -> view -> categoriesData = $this -> categoriesData;
        }
    }
}

?>
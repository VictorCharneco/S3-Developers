<?php


class AddfilmController extends ApplicationController{
    public $moviesData;
    public $categoriesData;

    public function addfilmAction(){

        $this -> moviesData = UtilityModel::getFilmsData();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $name = $_POST["name"];
            $description = $_POST["description"];
            $urlImage = null;
        
            $newFilm = new Movie ($name, $description);

            $categoryId = (int)$_POST["categories"];
            $newFilm -> setCategory($categoryId);

            if(!empty($_FILES["file"]["name"])){
                $dire = "images/filmCovers/";
                $fileName = basename($_FILES["file"]["name"]);
                $filePath = $dire . $newFilm -> getId() . $fileName;
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)){
                    $urlImage = "/" . $filePath;
            
                }
            }

            if ($urlImage){
                $newFilm -> setUrlImage($urlImage);
            }

            $newFilm -> addMovie();

            header("Location: /listFilms");
            exit();
        }else{
            $this -> categoriesData = UtilityModel::getJsonCategory()["category"];
            $this -> view -> categoriesData = $this -> categoriesData;
        }
    }

    public function categoryExists(int $categoryId):bool{
        $categoriesData = UtilityModel::getJsonCategory();
        foreach($categoriesData as $category){
            if($category["id"] === $categoryId){
                return true;
            }
        }
        return false;
    }

    
}


?>
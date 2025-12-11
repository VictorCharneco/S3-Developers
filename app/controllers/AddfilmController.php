<?php


class AddfilmController extends ApplicationController{
    public $moviesData;
    public $categoriesData;

    // This function uses the UtilityModel to get films data and once a POST value is included, creates
    // a new film with the form data and image. That image will be saved in the indicated folder($dire) with
    // a unique name using its id. Once it's created, redirects user to listFilms.
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
    
    // categoryExists check if a categori exists in Category.json
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
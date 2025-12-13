<?php

class UpdatefilmController extends ApplicationController{
    public $moviesData;
    public $categoriesData;

        
    /**
     * updatefilmAction
     * this function updates teh film by its ID. First it checks if it's a POST request and then gets the data.
     * Then it search the film by ID and update. If any image is included it saves it in the $dire folder.
     * The other fields will be updateed ONLY if are filled. INcase are blanked, wil keep the previous data.
     * Finally, it sends user to listFilms.
     * @return void
     */
    public function updatefilmAction(){
         
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id= (int)$_POST["select-movie"];
            $name = $_POST["name"];
            $description = $_POST["description"];
            $categoryId = (int)$_POST["categories"];

            $data = UtilityModel::getFilmsData();
            
            foreach($data["movie"] as &$movie){
                if($movie["id"] == $id){
                    if(!empty($name)) {
                        $movie["name"] = $name;
                    }
                    if(!empty($description)) {
                        $movie["description"] = $description;
                    }
                    if(!empty($categoryId)) {
                        $movie["categories"] = [$categoryId];
                    }

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
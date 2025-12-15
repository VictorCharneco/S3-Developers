<?php


class AddfilmController extends ApplicationController{
    public $moviesData;
    public $categoriesData;

    /**
     * addfilmAction
     * creates a new film with the form data and image. The image will be saved in the indicated folde ($dire)
     * with a unique name using its ID. Once it's created, redirects user to listFilms.
     * @return void
     */
    public function addfilmAction(){

        $this -> moviesData = UtilityModel::getFilmsData();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $name = $_POST["name"];
            $description = $_POST["description"];
            $urlImage = null;
            $newFilm = new Movie ($name, $description);

            $categoryId = (int)$_POST["categories"];
            $newFilm -> setCategory($categoryId);
            $urlVideo = $_POST["trailer"];
            parse_str(parse_url($urlVideo, PHP_URL_QUERY), $query);
            $videoId = $query['v'] ?? null;
            $embedUrl = "https://www.youtube.com/embed/$videoId?autoplay=1&mute=1&loop=1&playlist=$videoId";

            if(!empty($_FILES["file"]["name"])){
                $dire = "images/filmCovers/";
                $fileName = basename($_FILES["file"]["name"]);
                $filePath = $dire . $newFilm -> getId() . $fileName;
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)){
                    $urlImage = "/" . $filePath;
            
                }
            }

            if ($urlImage)
                $newFilm -> setUrlImage($urlImage);
            if($embedUrl)
                $newFilm -> setTrailerUrl($embedUrl);


            $newFilm -> addMovie();

            header("Location: /listFilms");
            exit();
        }else{
            $this -> categoriesData = UtilityModel::getJsonCategory()["category"];
            $this -> view -> categoriesData = $this -> categoriesData;
        }
    }
    

    /**
     * categoryExists
     *
     * @param  mixed $categoryId
     * checks if a category exists in Category.json 
     * @return bool
     */
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
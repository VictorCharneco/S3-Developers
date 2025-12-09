<?php

class ListfilmsController extends ApplicationController{

    public $moviesData;

    public function listFilmsAction(){
        $moviesData = (Movie::getAllMovies());
        $categoryData = UtilityModel::getJsonCategory()["category"];

        $categoryNameById = [];
        foreach($categoryData as $cat){
            $categoryNameById[$cat["id"]] = $cat["name"];
        }

        //--> TODO: añadir el catName a cada pelicula
        foreach($moviesData as &$movie){
            if(empty($movie["categories"])){
                $movie["categoryName"] = "Sin categoría";
            }else{
                $catId = $movie["categories"][0] ?? null;
                $movie["categoryName"] = $categoryNameById[$catId] ?? "Sin categoría";
            }
        
            if (!empty($movie["urlImage"])) {
                $imageFile = $movie["urlImage"];
            }else {
                $imageFile = strtolower($movie["name"]);
                $imageFile = str_replace(" ", "", $imageFile);
                $imageFile .= ".jpg";
            }
            $movie["imagePath"] = $imageFile;
        }
        $this->view->moviesData = $moviesData;
    }

}


?>
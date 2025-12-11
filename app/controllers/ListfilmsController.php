<?php

class ListfilmsController extends ApplicationController{

    public $moviesData;

    // This function gets all movies and each category by its ID. If a movie hasn't got category, shows "Sin Categorizar".
    public function listFilmsAction(){
        $moviesData = (Movie::getAllMovies());
        $categoryData = UtilityModel::getJsonCategory()["category"];

        $categoryNameById = [];
        foreach($categoryData as $cat){
            $categoryNameById[$cat["id"]] = $cat["name"];
        }

        foreach($moviesData as &$movie){
            if(empty($movie["categories"])){
                $movie["categoryName"] = "Sin categoría";
            }else{
                $catId = $movie["categories"][0] ?? null;
                $movie["categoryName"] = $categoryNameById[$catId] ?? "Sin categoría";
            };
            $movie["imagePath"] = $movie["urlImage"];
        }
        $this->view->moviesData = $moviesData;
    }

}


?>
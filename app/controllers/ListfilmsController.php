<?php

class ListfilmsController extends ApplicationController{

    public $moviesData;

    /**
     * listFilmsAction
     * This function gets all movis and each category by its ID. If a movie hasn't got category,
     * will be shows "sin Categoría".
     * @return void
     */
    public function listFilmsAction(){
        $moviesData = (Movie::getAllMovies());
        $categoryData = UtilityModel::getJsonCategory()["category"];

        $categoryNameById = [];
        foreach($categoryData as $cat){
            $categoryNameById[$cat["id"]] = $cat["name"];
        }
    private $filmsBuyedByUser = [];



    public function listFilmsAction(){
         $this->moviesData = Movie::getAllMovies();
        $user = new User ($_SESSION["username"],false);
        $this -> filmsBuyedByUser = $user->getBuyedFilms();
        $this->view->moviesData = $this->moviesData;
        $this->view->filmsBuyedByUser = $this->filmsBuyedByUser;
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
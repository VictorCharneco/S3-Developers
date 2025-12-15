<?php

class ListfilmsController extends ApplicationController{

    public $moviesData;

    private $filmsBuyedByUser = [];

    /**
     * listFilmsAction
     * This function gets all movis and each category by its ID. If a movie hasn't got category,
     * will be shows "sin Categoría".
     * @return void
     */
    public function listFilmsAction(){
        $this->moviesData = Movie::getAllMovies();
        $categoryData = UtilityModel::getJsonCategory()["category"];

        $categoryNameById = [];
        foreach($categoryData as $cat){
            $categoryNameById[$cat["id"]] = $cat["name"];
        }
    
        if(!empty($_SESSION["username"])){
            $user = new User ($_SESSION["username"],false);
            $this -> filmsBuyedByUser = $user->getBuyedFilms();
            $this->view->moviesData = $this->moviesData;
            $this->view->filmsBuyedByUser = $this->filmsBuyedByUser;
        }


            foreach($this -> moviesData as &$movie){
            if(empty($movie["categories"])){
                $movie["categoryName"] = "Sin categoría";
            }else{
                $catId = $movie["categories"][0] ?? null;
                $movie["categoryName"] = $categoryNameById[$catId] ?? "Sin categoría";
            };
            $movie["imagePath"] = $movie["urlImage"];
        }
         $this->view->moviesData = $this->moviesData;
            $this->view->filmsBuyedByUser = $this->filmsBuyedByUser;
        $this->view->moviesData = $this -> moviesData;
    }


    }



?>
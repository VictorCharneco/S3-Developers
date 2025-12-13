<?php

class ListfilmsController extends ApplicationController{

    public $moviesData;

    private $filmsBuyedByUser = [];



    public function listFilmsAction(){
         $this->moviesData = Movie::getAllMovies();
        $user = new User ($_SESSION["username"],false);
        $this -> filmsBuyedByUser = $user->getBuyedFilms();
        $this->view->moviesData = $this->moviesData;
        $this->view->filmsBuyedByUser = $this->filmsBuyedByUser;
    }

    

}


?>
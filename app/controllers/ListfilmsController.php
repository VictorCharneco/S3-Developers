<?php

class ListfilmsController extends ApplicationController{

    public $moviesData;

    public function listFilmsAction(){
        $moviesData = (Movie::getAllMovies());
        $this->moviesData = $moviesData;
    }

    

}


?>
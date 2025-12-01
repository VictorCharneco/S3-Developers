<?php

class ListfilmsController extends ApplicationController{

    public function listFilmsAction(){
        print_r(Movie::getAllMovies());
    }

}


?>
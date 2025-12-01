<?php

class AddfilmController extends ApplicationController{

    public function addFilmAction(){
    $name = "Interstellar";
    $description = "Una pasada de película. PELICULÓN.";

    $movie = new Movie($name, $description);
    $movie->addMovie();
    

    }

}


?>
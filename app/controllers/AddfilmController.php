<?php

class AddfilmController extends ApplicationController{


    public function addfilmAction(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $name = $_POST["name"];
            $description = $_POST["description"];
            $movie = new Movie ($name, $description);
            $movie -> addMovie();
            header("Location: /listFilms");
            exit();
        }
    }

    
}


?>
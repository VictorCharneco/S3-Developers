<?php

class DeletefilmController extends ApplicationController{
    
    public function deleteFilmAction(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = intval($_POST["film"]);
            Movie::deleteMovie($id);
            header("Location: /listFilms");
            exit();
        }
    }

}

?>
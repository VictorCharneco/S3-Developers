<?php

class DeletefilmController extends ApplicationController{
    
    // This function deletes the film by its ID. By intval, we certify that the value is an INT by casting it.
    // Once its done, sends user to lisftFilms.
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
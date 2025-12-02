<?php

class DeletefilmController extends ApplicationController{
    
    public function deleteFilmAction(){
        $id = 0;
        Movie::deleteMovie($id);
    }
}

?>
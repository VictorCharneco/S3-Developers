<?php


class LibraryController extends ApplicationController{

    private array $myFilms;
    private bool $emptyFilms = false;

    private array $buyedFilms = [];
    public function libraryAction(){
        $user = new User($_SESSION["username"],false); 
        $filmsBuyed = $user -> getBuyedFilms();
        if(empty( $filmsBuyed ))
            $this -> emptyFilms = true;
        else{
            $this -> emptyFilms = false;
            $this -> myFilms = Movie::getFilmsById($filmsBuyed);
            $this -> view -> myFilms = $this -> myFilms;
        }
        $this -> view -> emptyFilms = $this -> emptyFilms;
    }
}


?>
<?php

class BuyFilmController extends ApplicationController {
    public string $filmError;
    public function buyFilmAction(): void{
        $filmId = $_POST["filmId"]; 
        $user = new User($_SESSION["username"],$_SESSION["password"],false);
        $user -> buyFilm(id: $filmId);
        header("Location: " . WEB_ROOT . "/listFilms");          

    }
}


?>
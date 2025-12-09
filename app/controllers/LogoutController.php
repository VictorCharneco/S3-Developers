<?php

class LogoutController extends ApplicationController{
    public function logoutAction(){
        session_destroy();
        header(header: "Location: " . WEB_ROOT . "/home");    
    }
}

?>
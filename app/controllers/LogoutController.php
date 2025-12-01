<?php


class LogoutController extends ApplicationController{
    public function logoutAction(){
        session_destroy();
        
    }
}

?>
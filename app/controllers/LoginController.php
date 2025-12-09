<?php

class LoginController extends ApplicationController{

    public $validotionText;

    /**
     * loginAction
     * Handles user login
     * Must be called via POST
     *
     * @return void
     */
    public function loginAction(){
        if($this->getRequest()->isPost()){
            $username = $this-> _getParam("username");
            $password = $this->_getParam("password");
            //we have to validate the user
            $user = new User($username, $password,false);
            if($user->loginUser()){
                    //User is valid, we start the session
                $_SESSION["username"] = $username;
                $_SESSION["password"] = $password;
                $_SESSION["isLoggedIn"] = true;
                $_SESSION["urlAvatar"] = $user -> getUrlAvatar();
                $_SESSION["id"] = $user -> getId();
                    //Redirect to home or dashboard
                    header("Location: " . WEB_ROOT . "/home");
                    exit();
                }else{
                    $this -> view -> validationText = "Invalid username or password";
                }
        }
    }
}

?>
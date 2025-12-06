<?php
class RegisterController extends ApplicationController{

    private $data;

    public $userExistsError;
    public $usernamevalidationError;
    public $passwordvalidationError;

    public function registerAction(){
        $this->data = UtilityModel::getJsonDataUser();
        if($this->getRequest()->isPost()){
            $username = $this-> _getParam("username");
            $password = $this->_getParam("password");
            //we have to validate the inputs

                if(!FormValidations::validateUsername($username))
                {
                    $this -> usernamevalidationError = "Invalid username format.";
                }

                if(!FormValidations::validatePassword($password))
                {
                    $this -> passwordvalidationError = "Invalid password format.";
                }

                $user = new User($username, $password, true);
                if($user->registerUser()){
                    $_SESSION["username"] = $username;
                    $_SESSION["id"] = $user -> getId();
                    $_SESSION["password"] = $password;
                    $_SESSION["isLoggedIn"] = true;
                    $_SESSION["urlAvatar"] = $user ->getUrlAvatar();
                    header(header: "Location: " . WEB_ROOT . "/home");
                    exit();
                }else {
                    $this -> userExistsError = "User already exists.";
                }

                $this->view->userExistsError = $this -> userExistsError;
                $this -> view -> usernamevalidationError = $this -> usernamevalidationError;
                $this -> view -> passwordvalidationError = $this -> passwordvalidationError;
            }
               
          
    
    }


}


?>
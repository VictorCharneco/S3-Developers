<?php
class RegisterController extends ApplicationController{

    private $data;

    public $userExistsError;
    public $usernamevalidationError;
    public $passwordvalidationError;

    public function registerAction(){
        $this->data = UtilityModel::getJsonData();
        if($this->getRequest()->isPost()){
            $username = $this-> _getParam("username");
            $password = $this->_getParam("password");
            //we have to validate the inputs
            try{   
                if(!FormValidations::validateUsername($username)){

                    $this -> usernamevalidationError = "Invalid username format.";
                    throw new Exception(message: "Invalid username format.");
                }

                if(!FormValidations::validatePassword($password)){
                    $this -> passwordvalidationError = "Invalid password format.";
                    throw new Exception(message: "Invalid password format.");}
                $user = new User($username, $password, "");
                if($user->registerUser()){
                    $_SESSION["username"] = $username;
                    $_SESSION["isLoggedIn"] = true;
                    header("Location: " . WEB_ROOT . "/login");
                    exit();
                }else {
                    $this -> userExistsError = "User already exists.";
                    throw new Exception("User already exists.");
                }

            }catch(Exception $e){
                $this->view->userExistsError = $this -> userExistsError;
                $this -> view -> usernamevalidationError = $this -> usernamevalidationError;
                $this -> view -> passwordvalidationError = $this -> passwordvalidationError;
            }
    }
    }


}


?>
<?php
class RegisterController extends ApplicationController{
    public function registerAction(){
        if($this->getRequest()->isPost()){
            $username = $this-> _getParam("username");
            $password = $this->_getParam("password");
            //we have to validate the inputs
            try{   
                if(!FormValidations::validateUsername($username)){
                    throw new Exception("Invalid username format.");
                }

                if(!FormValidations::validatePassword($password)){
                    throw new Exception("Invalid password format.");
                }
                $user = new User($username, $password, "");
                if($user->registerUser()){
                    $_SESSION["username"] = $username;
                    $_SESSION["isLoggedIn"] = true;
                    header("Location: " . WEB_ROOT . "/home");
                    exit();
                }

            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
    }
}
}


?>
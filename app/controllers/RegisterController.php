<?php
class RegisterController extends ApplicationController{
    public function registerAction(){
        if($this->getRequest()->isPost()){
            $username = $this-> _getParam("username");
            $password = $this->_getParam("password");
            //we have to validate the inputs
            try{   
                if(!UtilityModel::validateUsername($username)){
                    throw new Exception("Invalid username format.");
                }

                if(!UtilityModel::validatePassword($password)){
                    throw new Exception("Invalid password format.");
                }
                $user = new User($username, $password, "");
                if($user->registerUser()){
                    $_SESSION["username"] = $username;
                    $_SESSION["isLoggedIn"] = true;
                    header("Location: " . WEB_ROOT . "/test");
                    exit();
                }

            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
    }
}
}


?>
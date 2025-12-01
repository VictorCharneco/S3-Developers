<?php

class LoginController extends ApplicationController{

        
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
            try{
                $user = new User($username, $password, "");
                if($user->loginUser()){
                    //User is valid, we start the session
                    $_SESSION["username"] = $username;
                    $_SESSION["isLoggedIn"] = true;
                    //Redirect to home or dashboard
                    header("Location: " . WEB_ROOT . "/test");
                    exit();
                }else{
                    throw new Exception("Invalid username or password.");
                }

            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
        }
    }
}

?>
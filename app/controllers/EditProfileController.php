<?php

class EditProfileController extends ApplicationController {

    private $data;

    public $userExistsError;
    public $usernamevalidationError;
    public $passwordvalidationError;




    public function editProfileAction(){
        $emptyUsername = false;
        $emptyPassword = false;
        $emptyAvatar = false;


        $this->data = UtilityModel::getJsonDataUser();

        if ($this->getRequest()->isPost()) {
            $username = $this->_getParam("username");
            $password = $this->_getParam("password");
            $nameAvatar = $_FILES["urlAvatar"]["name"];
            $emptyUsername = empty($username);
            $emptyPassword = empty($password);
            $emptyAvatar  = empty($nameAvatar);

            if(!$emptyUsername){
                if (!FormValidations::validateUsername($username)) {
                    $this->usernamevalidationError =  "Username must be 3–20 characters long and may only contain letters, numbers, and underscores.";
                }
            }

            if(!$emptyPassword){
                if (!FormValidations::validatePassword($password)) {
                $this->passwordvalidationError = "Password must be at least 8 characters long and include at least one letter and one number.";
                }
            }


            // Si hay errores de validación, mostramos y salimos
            if ($this->usernamevalidationError || $this->passwordvalidationError) {
                $this->view->usernamevalidationError = $this->usernamevalidationError;
                $this->view->passwordvalidationError = $this->passwordvalidationError;
                return;
            }

            // Crear objeto usuario actual
            $user = new User($username, $password,false);
            // Intentar editar
            if ($user->editUser($_SESSION["id"],$username,$password,$nameAvatar)) {
                if(!$emptyAvatar){
                    $user->setUrlAvatar($nameAvatar);
                    $temp = $_FILES["urlAvatar"]["tmp_name"];
                    move_uploaded_file($temp, __DIR__ . "/../../web/images/userAvatars/". $nameAvatar);
                    $_SESSION["urlAvatar"] = "/images/userAvatars/" . $nameAvatar;
                }


                $_SESSION["username"] = $username;
                $_SESSION["password"] = $password;
                $_SESSION["isLoggedIn"] = true;
                header("Location: " . WEB_ROOT . "/home");
                exit();
            } else {
                $this->userExistsError = "User already exists.";
                $this->view->userExistsError = $this->userExistsError;
            }
        }
    }
}

?>
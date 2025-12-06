<?php

class EditProfileController extends ApplicationController {

    private $data;

    public $userExistsError;
    public $usernamevalidationError;
    public $passwordvalidationError;

    public function editProfileAction(){
        $this->data = UtilityModel::getJsonDataUser();

        if ($this->getRequest()->isPost()) {
            $username = $this->_getParam("username");
            $password = $this->_getParam("password");
            $nameAvatar = $_FILES["urlAvatar"]["name"];

            // Validaciones
            if (!FormValidations::validateUsername($username)) {
                $this->usernamevalidationError = "Invalid username format.";
            }

            if (!FormValidations::validatePassword($password)) {
                $this->passwordvalidationError = "Invalid password format.";
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
                $user->setUrlAvatar($nameAvatar);
                $temp = $_FILES["urlAvatar"]["tmp_name"];
                move_uploaded_file($temp, __DIR__ . "/../../web/images/userAvatars/". $nameAvatar);
                $_SESSION["username"] = $username;
                $_SESSION["password"] = $password;
                $_SESSION["urlAvatar"] = "/images/userAvatars/" . $nameAvatar;
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
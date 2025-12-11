<?php
class RegisterController extends ApplicationController {

    private $data;
    private bool $validation = false;
    public $userExistsError;
    public $usernamevalidationError;
    public $passwordvalidationError;

    public function registerAction() {
        $this->data = UtilityModel::getJsonDataUser();

        if ($this->getRequest()->isPost()) {
            $username = $this->_getParam("username");
            $password = $this->_getParam("password");

            // Validaciones
            if (!FormValidations::validateUsername($username)) {
                $this->usernamevalidationError = 
                "Username must be 3–20 characters long and may only contain letters, numbers, and underscores.";
            }

            if (!FormValidations::validatePassword($password)) {
                $this->passwordvalidationError = "Password must be at least 8 characters long and include at least one letter and one number.";
            }

            $this->validation = (FormValidations::validateUsername($username) && FormValidations::validatePassword($password));

            if ($this->validation) {
                $user = new User($username, $password, true);

                if (!$user->checkIfUsernameExists($username)) {
                    if ($user->registerUser()) {
                        $_SESSION["username"]   = $username;
                        $_SESSION["id"]         = $user->getId();
                        $_SESSION["password"]   = $password;
                        $_SESSION["isLoggedIn"] = true;
                        $_SESSION["urlAvatar"]  = $user->getUrlAvatar();

                        header("Location: " . WEB_ROOT . "/home");
                        exit();
                    }
                } else {
                    $this->userExistsError = "User already exists.";
                }
            }

            // Send validations to the view
            $this->view->userExistsError          = $this->userExistsError;
            $this->view->usernamevalidationError  = $this->usernamevalidationError;
            $this->view->passwordvalidationError  = $this->passwordvalidationError;
        }
    }
}
?>
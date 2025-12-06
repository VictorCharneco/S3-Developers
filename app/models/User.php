<?php

    class User extends Model{

        private $id;
        private $username;
        private $password;
        private $email;

        private string $urlAvatar;

      public function __construct($username, $password, $isNew = true) {
            $this->username = $username;
            $this->password = $password;

            $data = UtilityModel::getJsonDataUser();

            if ($isNew) {
                foreach($data["users"] as $user) {
                    if ($username == $user["username"]) {
                        throw new Exception("El usuario ya existe");
                    }
                }
                 if(!empty($data["users"])){ 
                    $lastUser = end($data["users"]); $this->id = $lastUser["id"] + 1; 
                }else { 
                    $this->id = 1;
                }
            }else {
                 foreach ($data["users"] as $user) {
                    if ($username == $user["username"] && $password == $user["password"]) {
                    $this->id = $user["id"];
                    $this->urlAvatar = $user["urlAvatar"] ?? "images/userAvatars/avatar-empty.png";
                    break;
            }
        }

            }
    }
    

    //GETTERS AND SETTERS
        public function getId(){
            return $this->id;
        }
        public function getUsername(){
            return $this->username;
        }

        public function getUrlAvatar(): string
        {
            return $this->urlAvatar;
        }   

        public function getPassword(){
            return $this->password;
        }
        public function getEmail(){
            return $this->email;
        }

        public function setUsername($username){
            $this->username = $username;
        }
        public function setPassword($password){
            $this->password = $password;
        }
        public function setEmail($email){
            $this->email = $email;
        }

        public function setUrlAvatar($url){
            $this->urlAvatar = AVATAR_PATH . $url;
        }
        public function __toString(){   
            return $this->username ." ". $this->password ." ". $this->email;
        }

    //VICTOR Y VICENS ECHADLE UN OJO A LOS COMENTARIOS PARA QUE OS QUEDE MAS CLARO EL CODIGO !!!
    //LOGIC FUNCTIONS
    //THIS FUNCTIONS ARE CALLED FROM CONTROLLERS !!!
    //CONTROLLERS VALIDATES INPUT DATA BEFORE CALLING THESE FUNCTIONS !!!
    public function registerUser(){
        $userExists = false;
        //First we need to get json data
        $data = UtilityModel::getJsonDataUser();
        //Check if username exists
        foreach($data["users"] as $user){
            if($user["username"] == $this -> username){
                $userExists = true;
                return false;
            }
        }
        //If user does not exist we register it
        if(!$userExists){   
            $this -> urlAvatar = EMPTY_AVATAR_PATH;
            $data["users"][] = ["id" => $this -> id , "username" => $this -> username, "password" => $this -> password, "urlAvatar" => $this -> urlAvatar];
            UtilityModel::saveJsonDataUser($data);
            return true;
        }
    }

    public function loginUser(){
        //First we need to get json data
        $data = UtilityModel::getJsonDataUser();
        //Check if username && password are the same
        foreach($data["users"] as $user){
            if($user["username"] == $this -> username && $user["password"] == $this -> password){
                //User exists and I return true (Controller will create and start the session)
                $this -> urlAvatar = $user["urlAvatar"];
                return true;
            }
        }
    }


    public function getUserById($id): User{
        //
        $userData = UtilityModel::getJsonDataUser();
        foreach($userData["users"] as $user){
            if($user["id"] == $id)
                return new User($user["username"],$user["password"]);
        }
        Throw new Exception("El user no existe");
    }


    public function editUser(int $id, string $username, string $password,string $avatarFile){
    $data = UtilityModel::getJsonDataUser();

    // Verificar si el username ya existe en otro usuario
    foreach($data["users"] as $user){
        if($user["username"] == $username){
            return false; 
        }
    }

    foreach ($data["users"] as $key => $user) {
        if ($user["id"] == $id) {
            $data["users"][$key]["username"] = $username;
            $data["users"][$key]["password"] = $password;
            if (!empty($avatarFile)) 
                $data["users"][$key]["urlAvatar"] = "/images/userAvatars/" . $avatarFile;
            

            UtilityModel::saveJsonDataUser($data);

            return true; // edición exitosa
        }


    }

    return false; // si no se encontró el usuario
}

    public function saveAvatarFile($fileImage){
        //We have to save avatar Image on web/images/userAvatars
        move_uploaded_file($fileImage, "web/images/userAvatars");
    }
    }

?>
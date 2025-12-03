<?php

    class User extends Model{

        private static $counter = 0;
        private $id;
        private $username;
        private $password;
        private $email;

        public function __construct($username, $password, $email){
           $data = UtilityModel::getJsonData();
           if(!empty($data["users"])){
               $lastUser = end($data["users"]);
               $this->id = $lastUser["id"] + 1;
           }else {
            $this->id = 1;  
           }
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;

        }


    //GETTERS AND SETTERS
        public function getId(){
            return $this->id;
        }
        public function getUsername(){
            return $this->username;
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
        $data = UtilityModel::getJsonData();
        //Check if username exists
        foreach($data["users"] as $user){
            if($user["username"] == $this -> username){
                $userExists = true;
                return false;
            }
        }
        //If user does not exist we register it
        if(!$userExists){   
            $data["users"][] = ["id" => $this -> id , "username" => $this -> username, "password" => $this -> password];
            UtilityModel::saveJsonData($data);
            return true;
        }
    }

    public function loginUser(){
        //First we need to get json data
        $data = UtilityModel::getJsonData();
        //Check if username && password are the same
        foreach($data["users"] as $user){
            if($user["username"] == $this -> username && $user["password"] == $this -> password){
                //User exists and I return true (Controller will create and start the session)
                return true;
            }
        }
    }
    }

?>
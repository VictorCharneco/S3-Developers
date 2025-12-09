<?php

class FormValidations extends Model{
    
    //REGEX FOR VALIDATIONS
    public static $emailRegex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    public static $passwordRegex = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/"; // Minimum eight characters, at least one letter and one number
    public static $usernameRegex = "/^[a-zA-Z0-9_]{3,20}$/"; // Alphanumeric usernames between 3 and 20 characters


    public static function validateEmail($email){
        return preg_match(self::$emailRegex, $email);
    }

    public static function validatePassword($password){
        return preg_match(self::$passwordRegex, $password);
    }

    public static function validateUsername($username){
        return preg_match(self::$usernameRegex, $username);
    }

    
    
}


?>
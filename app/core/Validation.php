<?php

namespace App\Model;

use App\Core\Database;
use PDO;
use PDOException;

class Validation {

    public static function validateUsername($username) {
        return preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username);
    }

    public static function validatePassword($password) {

        return preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password);
    }

    public static function validateTextarea($textarea) {
        return !empty($textarea) && strlen($textarea) <= 1000;
    }

    public static function validateText($text) {

        return !empty($text);
    }


    public static function validate($input, $type) {
        switch ($type) {
            case 'name':

                return self::validateUsername($input);

            case 'password':

                return self::validatePassword($input);

            case 'textarea':
                
                return self::validateTextarea($input);

            case 'text':
                return self ::validateText($input);
                
            default:
                return false;
        }
    }


    public static function sanitize($input) {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }
}
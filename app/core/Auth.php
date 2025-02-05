<?php

namespace App\Core;

use App\Models\User;

class Auth {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new User();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    

    public function check() {
        return isset($_SESSION['user_id']);
    }
    

    public function user() {
        if ($this->check()) {
            return $this->userModel->findById($_SESSION['user_id']);
        }
        return null;
    }
    

    public function login($username, $password) {
        $user = $this->userModel->findByUsername($username);
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return true;
        }
        
        return false;
    }
    

    public function register($username, $password) {
        if ($this->userModel->findByUsername($username)) {
            return false; 
        }
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        return $this->userModel->create($username, $hashedPassword);
    }
    

    public function logout() {
        session_unset();
        session_destroy();
    }
}

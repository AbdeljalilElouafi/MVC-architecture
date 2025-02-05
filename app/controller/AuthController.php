<?php

namespace App\Controller;

use App\Core\Auth; 
use App\Models\User;
use App\Core\Controller;

class AuthController extends Controller {
    private $auth;
    
    public function __construct() {
        $this->auth = new Auth(); 
    }
    
    public function showLogin() {
        $this->render('auth/login.blade');
    }
    
    public function showRegister() {
        $this->render('auth/register.blade');
    }
    

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            if ($this->auth->login($username, $password)) {
                header('Location: /dashboard');
                exit;
            } else {
                $error = 'Invalid username or password';
                $this->render('auth/login.blade', ['error' => $error]);
            }
        }
    }
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            
            $errors = [];
            
            if (empty($username)) {
                $errors[] = 'Username is required';
            }
            if (empty($password)) {
                $errors[] = 'Password is required';
            }
            if ($password !== $confirmPassword) {
                $errors[] = 'Passwords do not match';
            }
            
            if (empty($errors)) {
                if ($this->auth->register($username, $password)) {
                    header('Location: /auth/login');
                    exit;
                } else {
                    $errors[] = 'Username already exists';
                }
            }
            
            $this->render('auth/register.blade', ['errors' => $errors]);
        }
    }
    

    public function logout() {
        $this->auth->logout();
        header('Location: /auth/login');
        exit;
    }
}

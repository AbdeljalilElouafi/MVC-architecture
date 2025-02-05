<?php

namespace App\Controller;

use App\Models\User;
use App\Core\Controller;


class AuthController  extends Controller {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    
    public function showLogin() {

        $this->render('auth/login.blade');

        // require __DIR__ . '/../views/auth/login.blade.php';
    }
    
    public function showRegister() {
        $this->render('auth/register.blade');

        // require __DIR__ . '/../views/auth/register.blade.php';
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $user = $this->userModel->findByUsername($username);
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: /dashboard');
                exit;
            }
            
            $error = 'Invalid username or password';

            $this->render('auth/login.blade');

            // require 'views/auth/login.blade.php';
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
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                
                if ($this->userModel->create($username, $hashedPassword)) {
                    header('Location: /auth/login');
                    exit;
                } else {
                    $errors[] = 'Username already exists';
                }
            }
            $this->render('auth/register.blade');

            // require 'views/auth/register.php';
        }
    }
}
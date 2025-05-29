<?php
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/JwtService.php';

class AuthService {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function authenticate($email, $password) {
        $user = $this->userModel->findByEmail($email);
        
        if (!$user || !password_verify($password, $user['password'])) {
            return null;
        }

        return JwtService::generateToken([
            'userId' => $user['id'],
            'email' => $user['email'],
            'exp' => time() + 3600
        ]);
    }

    public function validate($token) {
        return JwtService::validateToken($token);
    }
}
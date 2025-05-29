<?php
require_once __DIR__ . '/../Services/AuthService.php';

class AuthController {
    private $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    public function login($request) {
        $token = $this->authService->authenticate(
            $request['email'], 
            $request['password']
        );

        if (!$token) {
            http_response_code(401);
            return ['error' => 'Invalid credentials'];
        }

        return ['token' => $token];
    }

    public function validateToken($token) {
        $decoded = $this->authService->validate($token);
        return ['auth' => (bool)$decoded];
    }
}
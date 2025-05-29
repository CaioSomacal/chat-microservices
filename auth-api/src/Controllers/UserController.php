<?php
require_once __DIR__ . '/../Models/User.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function createUser($data) {
        $userId = $this->userModel->create(
            $data['name'],
            $data['lastName'],
            $data['email'],
            $data['password']
        );

        return [
            'message' => 'User created successfully',
            'user' => [
                'id' => $userId,
                'email' => $data['email']
            ]
        ];
    }

    public function getUser($email) {
        $user = $this->userModel->findByEmail($email);
        if (!$user) {
            http_response_code(404);
            return ['error' => 'User not found'];
        }

        return [
            'name' => $user['name'],
            'lastName' => $user['last_name'],
            'email' => $user['email']
        ];
    }
}
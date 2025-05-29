<?php
require_once __DIR__ . '/Controllers/AuthController.php';
require_once __DIR__ . '/Controllers/UserController.php';

header("Content-Type: application/json");

$authController = new AuthController();
$userController = new UserController();

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestData = json_decode(file_get_contents('php://input'), true) ?? $_REQUEST;

// Rotas da API
switch ($requestMethod) {
    case 'POST':
        if ($requestUri === '/token') {
            echo json_encode($authController->login($requestData));
        } elseif ($requestUri === '/user') {
            echo json_encode($userController->createUser($requestData));
        }
        break;
        
    case 'GET':
        if (strpos($requestUri, '/token') === 0) {
            $token = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
            echo json_encode($authController->validateToken(str_replace('Bearer ', '', $token)));
        } elseif (strpos($requestUri, '/user') === 0) {
            $email = $_GET['email'] ?? '';
            echo json_encode($userController->getUser($email));
        }
        break;
        
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}
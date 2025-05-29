<?php
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Services/AuthService.php';
require_once __DIR__ . '/../config/redis.php';

class AuthTest {
    private $userModel;
    private $authService;
    private $redis;

    public function __construct() {
        $this->userModel = new User();
        $this->authService = new AuthService();
        
        // Configura Redis
        $redisConfig = include(__DIR__ . '/../config/redis.php');
        $this->redis = new Redis();
        $this->redis->connect(
            $redisConfig['host'], 
            $redisConfig['port']
        );
        if ($redisConfig['password']) {
            $this->redis->auth($redisConfig['password']);
        }
    }

    public function runTests() {
        $this->testUserCreation();
        $this->testAuthentication();
        $this->testTokenValidation();
        $this->testRedisCache();
    }

    // [...] (mantenha os outros métodos existentes)

    private function testRedisCache() {
        $token = $this->authService->authenticate(
            'test@example.com', 
            'password123'
        );
        
        $key = 'auth_token:' . md5($token);
        $cached = $this->redis->get($key);
        
        if ($cached) {
            echo "Redis cache test: PASSED (Token stored in cache)\n";
        } else {
            echo "Redis cache test: FAILED (Token not found in cache)\n";
        }
    }
}

(new AuthTest())->runTests();
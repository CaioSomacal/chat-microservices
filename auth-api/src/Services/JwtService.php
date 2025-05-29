<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService {
    private static $secretKey = "your_secret_key";
    private static $algorithm = 'HS256';

    public static function generateToken($payload) {
        return JWT::encode($payload, self::$secretKey, self::$algorithm);
    }

    public static function validateToken($token) {
        try {
            return JWT::decode($token, new Key(self::$secretKey, self::$algorithm));
        } catch (Exception $e) {
            return null;
        }
    }
}
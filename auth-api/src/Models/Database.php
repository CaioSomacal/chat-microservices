<?php
class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $config = include(__DIR__ . '/../config/database.php');
        try {
            $this->connection = new PDO(
                "{$config['driver']}:host={$config['host']};dbname={$config['database']}",
                $config['username'],
                $config['password']
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance->connection;
    }
}
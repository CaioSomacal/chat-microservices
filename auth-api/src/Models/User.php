<?php
require_once __DIR__ . '/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create($name, $lastName, $email, $password) {
        $stmt = $this->db->prepare(
            "INSERT INTO users (name, last_name, email, password) 
             VALUES (:name, :last_name, :email, :password)"
        );
        $stmt->execute([
            ':name' => $name,
            ':last_name' => $lastName,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_BCRYPT)
        ]);
        return $this->db->lastInsertId();
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
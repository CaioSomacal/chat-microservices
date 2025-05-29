<?php
$db = require __DIR__ . '/../config/database.php';

try {
    $pdo = new PDO(
        "{$db['driver']}:host={$db['host']};port={$db['port']}",
        $db['username'],
        $db['password']
    );

    // Criar banco se não existir
    $pdo->exec("CREATE DATABASE IF NOT EXISTS {$db['database']}");
    $pdo->exec("USE {$db['database']}");

    // Criar tabela de usuários
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id SERIAL PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            last_name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    // Criar índices para melhor performance
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_users_email ON users(email)");
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_users_created_at ON users(created_at)");

    echo "Database and tables created successfully with indexes!\n";
} catch (PDOException $e) {
    die("Migration failed: " . $e->getMessage());
}
<?php
return [
    'driver'    => 'pgsql',
    'host'      => getenv('DB_HOST') ?: 'postgres',
    'port'      => getenv('DB_PORT') ?: 5432,
    'database'  => getenv('DB_NAME') ?: 'auth_db',
    'username'  => getenv('DB_USER') ?: 'user',
    'password'  => getenv('DB_PASS') ?: 'password',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
    'options'   => [
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_TIMEOUT => 30
    ]
];
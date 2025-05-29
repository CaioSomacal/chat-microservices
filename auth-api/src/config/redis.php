<?php
return [
    'scheme'    => 'tcp',
    'host'      => getenv('REDIS_HOST') ?: 'redis',
    'port'      => getenv('REDIS_PORT') ?: 6379,
    'password'  => getenv('REDIS_PASSWORD') ?: null,
    'database'  => 0,
    'read_write_timeout' => 0,
    
    // Configurações de cache
    'cache' => [
        'enabled' => true,
        'prefix'  => 'auth_',
        'ttl'     => 3600 // 1 hora
    ]
];
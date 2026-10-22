<?php

return [
    'mysql' => [
        'local' => [
            'DB_HOST'     => '127.0.0.1',
            'DB_PORT'     => '3306',
            'DB_DATABASE' => '',
            'DB_USERNAME' => 'root',
            'DB_PASSWORD' => '123456',
        ],
        'dev'   => [
            'DB_HOST'     => '127.0.0.1',
            'DB_PORT'     => '3306',
            'DB_DATABASE' => '',
            'DB_USERNAME' => 'root',
            'DB_PASSWORD' => '123456',
        ],
        'prod'  => [
            'DB_HOST'     => '127.0.0.1',
            'DB_PORT'     => '3306',
            'DB_DATABASE' => '',
            'DB_USERNAME' => 'root',
            'DB_PASSWORD' => '123456',
        ],
    ],
    'mongo' => [
        'local' => [
            'MONGO_HOST'        => '127.0.0.1',
            'MONGO_PORT'        => '27017',
            'MONGO_DATABASE'    => '',
            'MONGO_USERNAME'    => 'root',
            'MONGO_PASSWORD'    => '123456',
            'MONGO_AUTH_SOURCE' => '',
        ],
        'dev'   => [
            'MONGO_HOST'        => '127.0.0.1',
            'MONGO_PORT'        => '27017',
            'MONGO_DATABASE'    => '',
            'MONGO_USERNAME'    => 'root',
            'MONGO_PASSWORD'    => '123456',
            'MONGO_AUTH_SOURCE' => '',
        ],
        'prod'  => [
            'MONGO_HOST'        => '127.0.0.1',
            'MONGO_PORT'        => '27017',
            'MONGO_DATABASE'    => '',
            'MONGO_USERNAME'    => 'root',
            'MONGO_PASSWORD'    => '123456',
            'MONGO_AUTH_SOURCE' => '',
        ],
    ],
    'redis' => [
        'local' => [
            'REDIS_HOST' => '127.0.0.1',
            'REDIS_PORT' => '6379',
            'REDIS_PASSWORD' => '',
        ],
        'dev'   => [
            'REDIS_HOST' => '127.0.0.1',
            'REDIS_PORT' => '6379',
            'REDIS_PASSWORD' => '',
        ],
        'prod'  => [
            'REDIS_HOST' => '127.0.0.1',
            'REDIS_PORT' => '6379',
            'REDIS_PASSWORD' => '',
        ],
    ],
];
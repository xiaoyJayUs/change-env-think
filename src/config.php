<?php

return [
    'mysql' => [
        'local' => [
            'DB_HOST' => '127.0.0.1',
            'DB_NAME' => '',
            'DB_USER' => 'root',
            'DB_PASS' => '123456',
            'DB_PORT' => '3306',
        ],
        'dev'   => [
            'DB_HOST' => '127.0.0.1',
            'DB_NAME' => '',
            'DB_USER' => 'root',
            'DB_PASS' => '123456',
            'DB_PORT' => '3306',
        ],
        'prod'  => [
            'DB_HOST' => '127.0.0.1',
            'DB_NAME' => '',
            'DB_USER' => 'root',
            'DB_PASS' => '123456',
            'DB_PORT' => '3306',
        ],
    ],
    'mongo' => [
        'local' => [
            'MONGO_HOSTNAME'    => '127.0.0.1',
            'MONGO_DATABASE'    => '',
            'MONGO_USERNAME'    => 'root',
            'MONGO_PASSWORD'    => '123456',
            'MONGO_AUTH_SOURCE' => '',
            'MONGO_HOSTPORT'    => '27017',
        ],
        'dev'   => [
            'MONGO_HOSTNAME'    => '127.0.0.1',
            'MONGO_DATABASE'    => '',
            'MONGO_USERNAME'    => 'root',
            'MONGO_PASSWORD'    => '123456',
            'MONGO_AUTH_SOURCE' => '',
            'MONGO_HOSTPORT'    => '27017',
        ],
        'prod'  => [
            'MONGO_HOSTNAME'    => '127.0.0.1',
            'MONGO_DATABASE'    => '',
            'MONGO_USERNAME'    => 'root',
            'MONGO_PASSWORD'    => '123456',
            'MONGO_AUTH_SOURCE' => '',
            'MONGO_HOSTPORT'    => '27017',
        ],
    ],
    'redis' => [
        'local' => [
            'REDIS_HOST' => '127.0.0.1',
            'REDIS_PASS' => '',
            'REDIS_PORT' => '6379',
        ],
        'dev'   => [
            'REDIS_HOST' => '127.0.0.1',
            'REDIS_PASS' => '',
            'REDIS_PORT' => '6379',
        ],
        'prod'  => [
            'REDIS_HOST' => '127.0.0.1',
            'REDIS_PASS' => '',
            'REDIS_PORT' => '6379',
        ],
    ],
];
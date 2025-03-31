<?php

namespace XiaoyJayUs;

abstract class Config
{
    public static function get()
    {
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
    }
}

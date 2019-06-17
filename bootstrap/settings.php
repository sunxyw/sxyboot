<?php
// settings.php

return [
    'settings' => [
        'displayErrorDetails' => true, // 是否显示错误详情。务必在线上设为 false ！！！
        'addContentLengthHeader' => false, // 设为 true 以在每次响应中添加 Content-Length Header

        // Blade，或者说模板引擎的配置
        'renderer' => [
            'template_path' => __DIR__ . '/../resources/view/',
            'cache_path' => __DIR__ . '/../storage/cache',
        ],

        // 数据库配置
        'database' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => '',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
        ],
    ],
];
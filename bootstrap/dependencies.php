<?php

use Slim\App;
use Slim\Container;
use Slim\Views\Blade;

return function (App $app) {
    // 获取容器实例
    $container = $app->getContainer();

    // 配置 Blade 作为模板引擎
    $container['renderer'] = function (Container $c) {
        $settings = $c->get('settings')['renderer'];
        return new Blade($settings['template_path'], $settings['cache_path']);
    };

    // 配置 Eloquent ORM
    $container['db'] = function (Container $c) {
        global $capsule;

        return $capsule;
    };
};
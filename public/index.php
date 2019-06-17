<?php

use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager;
use Slim\App;

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

// 创建 App 实例
$settings = require __DIR__ . '/../bootstrap/settings.php';
$app = new App($settings);
$container = $app->getContainer();

// 设置 Carbon 的语言以及默认时区
Carbon::setLocale('zh');
date_default_timezone_set('Asia/Shanghai');

// 启动 Eloquent ORM
$capsule = new Manager;
$capsule->addConnection($container->get('settings')['database']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// 加载依赖
$dependencies = require __DIR__ . '/../bootstrap/dependencies.php';
$dependencies($app);

// Utils.php 是我自己写的函数库
require_once __DIR__ . '/../bootstrap/utils.php';

// 注册全局中间件
$middleware = require __DIR__ . '/../bootstrap/middleware.php';
$middleware($app);

// 注册路由
require __DIR__ . '/../routes/web.php';

// 运行 App
$app->run();

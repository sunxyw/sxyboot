<?php

use Slim\App;

return function (App $app) {
    // 这里需要返回一个中间件，可以是函数或者类。
    // 如果传入类，该类需要有 __invoke 方法。
    // 具体可参阅官方文档: http://www.slimframework.com/docs/v3/concepts/middleware.html
    // e.g: $app->add(new \Slim\Csrf\Guard);
};
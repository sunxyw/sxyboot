<?php
// utils.php

use Overtrue\Validation\Translator;
use Overtrue\Validation\Validator;
use Slim\Http\Response;

// 跟 Laravel 的 view 用法基本一致
function view($path, array $args = [])
{
    global $container;

    return $container->get('renderer')->render($container->get('response'), $path, $args);
}

// 获取 Response 实例
function response(): Response
{
    global $container;

    return $container->get('response');
}

// 跟 Laravel 用途一致
function asset($path)
{
    $schema = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $path = trim($path, '/');
    $url = "{$schema}://{$host}/{$path}";

    return $url;
}

// 跟 Laravel 用途一致
function route($name, $args = [])
{
    global $container;

    if (is_object($args) && $args instanceof Model) {
        $args = [$args->getRouteKeyName() => $args->getRouteKey()];
    }

    return $container->get('router')->pathFor($name, $args);
}

// 在 Blade 模板中使用 `@auth` 会调用此函数。
function auth()
{
    // 见下方 Auth 类
    return new Auth();
}

// 在 Blade 模板中使用 `@method` 会调用此函数。
function method_field($method)
{
    return "<input type='hidden' name='_METHOD' value='{$method}'>";
}

function validate($data, array $rules): Validator
{
    $factory = new Overtrue\Validation\Factory(new Translator(require __DIR__ . '/../resources/lang/zh-CN.php'));
    $validator = $factory->make($data, $rules);

    return $validator;
}

// 一个（伪）认证类
class Auth
{
    public function guard()
    {
        return $this;
    }

    public function check()
    {
        if (isset($_SESSION['uid']) && is_numeric($_SESSION['uid'])) {
            return true;
        }

        return false;
    }

    public function user()
    {
        $user = 0;

        return $user;
    }
}
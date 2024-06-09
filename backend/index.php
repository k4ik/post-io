<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/includes/conn.php';

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
date_default_timezone_set("America/Sao_Paulo");

$dispatcher = simpleDispatcher(function(RouteCollector $r) {
    require __DIR__ . '/src/routes.php';
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        echo 'Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        http_response_code(405);
        echo 'Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        [$controller, $method] = $handler;
        $controller = new $controller($conn);

        $data = [];

        if($controller instanceof \Controller\PostController) {
            $data = getPostsData();
        } else if($controller instanceof \Controller\AuthController) {
            if($method === 'login') {
                $data = getLoginData();
            } else if($method === 'signup') {
                $data = getSignupData();
            }
        }

        $data = array_merge($data, $vars);
        call_user_func_array([$controller, $method], $vars);
        break;
}

function getPostsData() {
    return [
        'title' => $_POST["title"],
        'summary' => $_POST["summary"],
        'content' => $_POST["content"],
        'author' => $_POST["author"],
        'date' => date("Y-m-d"),
        'time' => date("H:i:s")
    ];
}

function getLoginData() {
    return [
        'email' => $_POST["email"],
        'password' => $_POST["password"]
    ];
}

function getSignupData() {
    return [
        'name' => $_POST["name"],
        'email' => $_POST["email"],
        'password' => $_POST["password"],
        'confirmPassword' => $_POST["confirmPassword"]
    ];
}
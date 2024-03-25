<?php

// Serve static files
if (php_sapi_name() === 'cli-server') {
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $publicPath = __DIR__ . '/public';
    $filePath = $publicPath . $url;

    if (is_file($filePath)) {
        return false;
    }
}


$routes = [
    '' => 'HomeController@index',
    '/login' => 'AuthController@login',
    '/login/authenticate' => 'AuthController@authenticate',
    '/dashboard' => 'DashboardController@index',
];

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url = rtrim($url, '/');
if (array_key_exists($url, $routes)) {
    $route = $routes[$url];
    list($controllerName, $action) = explode('@', $route);

    // Create an instance of the controller class
    if (file_exists("controllers/$controllerName.php")) {
        require_once "controllers/$controllerName.php";
    } else {
        http_response_code(404);
        echo '404 - Not Found';
        exit;
    }
    $controller = new $controllerName();

    // Call the action method
    $controller->$action();
} else {
    http_response_code(404);
    echo '404 - Not Found';
}
?>
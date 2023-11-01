<?php
require_once './routes.php';

// Routes
$routes = [
    '/' => 'home',
    '/submit-form' => 'submitForm',
    '/edit-form' => 'editForm',
];

if (isset($routes[$_SERVER['REQUEST_URI']])) {
    $action = $routes[$_SERVER['REQUEST_URI']];
    if (function_exists($action)) {
        call_user_func($action);
        exit();
    }
}

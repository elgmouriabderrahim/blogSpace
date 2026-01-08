<?php
require_once __DIR__ . '/../bootstrap/autoload.php';
use App\Core\Router;
session_start();

$router = new Router();
$router->get('/', "HomeController@index");

$router->get('/admin/dashboard', "AdminDashboardController@index");

$router->get('/admin/users', "AdminUserController@index");

$router->get('/admin/categories', "CategoriesController@index");

$router->post('/register', "AuthController@register");
$router->get('/register', "AuthController@register");

$router->get('/login', "AuthController@login");
$router->post('/login', "AuthController@login");

$router->get('/logout', "AuthController@logout");
$router->dispatch();

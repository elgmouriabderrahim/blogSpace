<?php
require_once __DIR__ . '/../bootstrap/autoload.php';
use App\Core\Router;
session_start();

$router = new Router();
$router->get('/', "HomeController@index");
$router->get('/home/index', "HomeController@index");
$router->get('/home/show', "HomeController@index");

$router->get('/admin/dashboard', "AdminDashboardController@index");

$router->get('/admin/users', "AdminUserController@index");

$router->post('/admin/users/ban', "AdminUserController@banUser");
$router->post('/admin/users/unban', "AdminUserController@unbanUser");

$router->get('/admin/categories', "AdminCategoryController@index");
$router->post('/admin/categories/create', "AdminCategoryController@create");
$router->post('/admin/categories/delete', "AdminCategoryController@delete");


$router->get('/author/dashboard', "AuthorDashboardController@index");
$router->post('/author/dashboard', "AuthorDashboardController@index");


$router->post('/author/articles/view', "AuthorArticlesController@viewArticle");

$router->get('/author/articles/create', "AuthorArticlesController@create");
$router->post('/author/articles/create', "AuthorArticlesController@create");
$router->get('/author/articles/edit', "AuthorArticlesController@edit");
$router->post('/author/articles/edit', "AuthorArticlesController@editform");
$router->post('/author/articles/delete', "AuthorArticlesController@delete");


$router->post('/register', "AuthController@registerform");
$router->get('/register', "AuthController@register");

$router->get('/login', "AuthController@login");
$router->post('/login', "AuthController@loginform");

$router->get('/logout', "AuthController@logout");
$router->dispatch();

<?php

// index
$app->any('/', function ($request, $response, $args) {
    require_once(__DIR__ . '/../index_page.php');
});
$app->any('/index.php', function ($request, $response, $args) {
    require_once(__DIR__ . '/../index_page.php');
});

// login/logout
$app->get('/login', 'LoginController:index')->setName('index');
$app->post('/auth', 'LoginController:auth')->setName('auth');
$app->get('/logout', 'LoginController:logout')->setName('logout');
$app->get('/register', 'RegisterController:index')->setName('register');
$app->post('/register', 'RegisterController:register');
$app->get('/about', 'AboutController:index')->setName('about');
$app->get('/proj_list', 'ProjectController:projects')->setName('projects');
$app->post('/project_add', 'ProjectController:add')->setName('project_add');

// redirect to php file
$app->any('/{filename}.php', function ($request, \Slim\Http\Response $response, $args) {
    $filename = realpath($args['filename'] . '.php');
    if (!$filename) {
        return $response->withStatus(404);
    }
    $base = dirname($filename);
    if (dirname(__DIR__) != $base) {
        return $response->withStatus(404);
    }

    require_once $filename;
});

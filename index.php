<?php

require 'api/vendor/autoload.php';
require 'php/pages/pages_controller.php';

//chamada do framework slim
$app = new \Slim\Slim();
$page = new PageController;

// http://estacionapa.com/login/index
$app->get('/login', function() use ($page) {
    echo $page->openPageByAccess();
});

// http://estacionapa.com/login/index
$app->get('/about', function() use ($page) {
    echo $page->getPage('html/pages/about.html');
});

// http://estacionapa.com/login/valid (user + pass)
$app->post('/login/valid', function() use ($app, $page) {
    $form = json_decode($app->request->getBody(), true);
    $login = $page->validLogin($form);
});


$app->get('/report/infUser', function() use ($app, $page) {
    if($page->getAccess() == 'a') 
        echo $page->getPage('html/forms/admin_relat_inf_user.html');
    
    else
        echo $page->openPageByAccess();
});

$app->post('/report/infUser/find', function() use ($app, $page) {
    $name = $app->request->getBody();
    $report = $page->reportInfUser($name);
    echo $report;
});

$app->get('/report/carXboard', function() use ($app, $page) {
    if($page->getAccess() == 'a') 
        echo $page->getPage('html/forms/admin_relat_placaxcarro.html');
    
    else
        echo $page->openPageByAccess();
});


$app->post('/report/carXboard/find', function() use ($app, $page) {
    $board = $app->request->getBody();
    $report = $page->reportCarXBoard($board);
    echo $report;
});

//http://estacionapa.com/sair
$app->get('/sair', function() use ($page) {
    echo $page->sair();
});

$app->run();
?>
<?php

require 'api/vendor/autoload.php';
require 'api/vendor/vrana/NotORM.php';

require 'php/access/access.php';
require 'php/backend_manager/backend_service.php';

//chamada do framework slim
$app = new \Slim\Slim(array('debug' => true));
$service = new BackEndService;
$access = $service->getAccess($_SERVER['HTTP_USER_AGENT']);

$app->error(function (\Exception $e) use ($app) {
    $app->render('error.php');
});

// http://estacionapa.com/
$app->get('/', function() use ($service) {
    echo $service->buildPage('index');
});

// http://estacionapa.com/login
$app->get('/login', function() use ($service) {
    echo $service->openPageByAccess();
});

// http://estacionapa.com/about
$app->get('/about', function() use ($service) {
    echo $service->buildPage('about');
});


// http://estacionapa.com/login/valid (user + pass)
$app->post('/login/valid', function() use ($app, $service) {
    $form = json_decode($app->request->getBody(), true);
    $login = $service->validLogin($form);
});

$app->get('/edit', function() use ($app, $service, $access) {
    if($access == 'a')
        echo $service->getPage('html/forms/admin_edit_users.html');

    else
        echo $service->openPageByAccess();
});

$app->post('/edit/park', function() use ($app, $service, $access) {
    //if($access == 'a')
        $form = json_decode($app->request->getBody(), true);
        $service->editPark($form);
    //else
       // echo $service->openPageByAccess();
});

$app->post('/edit/user', function() use ($app, $service, $access) {
    if($access == 'a') {
        $form = json_decode($app->request->getBody(), true);
        $service->editUser($form);
    }
    else
        echo $service->openPageByAccess();
});

$app->get('/delete', function() use ($service, $access) {
    if($access == 'a')
        echo $service->getPage('html/forms/admin_delet_user.html');

    else
        echo $service->openPageByAccess();
});

$app->get('/delete/parks', function() use ($service, $access) {
    if($access == 'a')
        echo 'DEVELOPMENT';

    else
        echo $service->openPageByAccess();
});

$app->post('/delete/user', function() use ($app, $service, $access) {
    if($access == 'a') {
        $form = json_decode($app->request->getBody(), true);
        $service->inactiveUser($form);
    }
    else
        echo $service->openPageByAccess();
});

$app->get('/register', function() use ($service) {
    echo $service->buildPage('register');
});

// http://estacionapa.com/register/user
$app->post('/register/client/added', function() use ($app, $service) {
    $form = json_decode($app->request->getBody(), true);
    $service->registerClient($form);
});

$app->post('/register/parks', function() use ($app, $service) {
   if($access == 'm'){
        $form = json_decode($app->request->getBody(), true);
        $service->registerPark($form);
    }
    else
        echo $service->openPageByAccess();
});

$app->get('/master.registerparks', function() use ($app, $service) {
   if($access == 'm'){
        echo $service->buildPage('m_registerParks');
    }
    else
        echo $service->openPageByAccess();
});

$app->post('/master.registerparks/added', function() use ($app, $service) {
   if($access == 'm'){
        $form = json_decode($app->request->getBody(), true);
        $service->registerPark($form);
    }
    else
        echo $service->openPageByAccess();
});

// http://estacionapa.com/register/user
$app->get('/master.registeruser', function() use ($service, $access) {
    if($access == 'm')
        echo $service->buildPage('m_cadPerson');

    else
        echo $service->openPageByAccess();
});

// http://estacionapa.com/register/user
$app->post('/register/user/added', function() use ($app, $service, $access) {
    if($access == 'a' or $access == 'm') {
        $form = json_decode($app->request->getBody(), true);
        $service->registerUser($form);
    }
    else
        echo $service->openPageByAccess();
});

$app->get('/master.registercars', function() use ($service, $access) {
    if($access == 'a' || $access == 'c' || $access == 'f' || $access == 'm')
        echo $service->buildPage('m_cadCars');

    else
        echo $service->openPageByAccess();
});

$app->post('/register/cars/added', function() use ($app, $service, $access) {
    if($access == 'a' || $access == 'c' || $access == 'f' || $access == 'm' || 
       $access == 'valid') {
        $form = json_decode($app->request->getBody(), true);
        $service->registerCar($form);
    }
    else
        echo $service->openPageByAccess();
});

$app->get('/report/infUser', function() use ($app, $service, $access) {
    if($access == 'a') 
        echo $service->getPage('html/forms/admin_relat_inf_user.html');
    
    else
        echo $service->openPageByAccess();
});

$app->get('/report/infUser/:name', function($name) use ($app, $service, $access) {
    if($access == 'a'){
        $report = $service->reportInfUser($name);
        echo $report;
    }
    else
        echo $service->openPageByAccess();
});

$app->get('/report/carXboard', function() use ($app, $service, $access) {
    if($access == 'a') 
        echo $service->getPage('html/forms/admin_relat_placaxcarro.html');
    
    else
        echo $service->openPageByAccess();
});

$app->get('/report/carXboard/:board', function($board) use ($app, $service, $access) {
    if($access == 'a'){
        $report = $service->reportCarXBoard($board);
        echo $report;
    }
    else
        echo $service->openPageByAccess();
});

$app->post('/request/login', function() use ($app, $service, $access) {
    $data = json_decode($app->request->getBody(), true);
    //echo strpos($_SERVER['HTTP_USER_AGENT'], 'Android');
    echo $service->getAccessMobile($data);
});

$app->post('/vacancies/consult', function() use ($app, $service) {
        $form = json_decode($app->request->getBody(), true);
        //array(
        //'hora_reserva' => 'HH:MM:00',
        //'hora_fim' => 'HH:MM:00',
        //'data' => 'DD/MM/YYYY'
        //);
        $service->vacanciesConsult($form);
});

$app->post('/vacancies/request', function() use ($app, $service, $access) {
    if($access == 'a' or $access == 'valid'){
        $form = json_decode($app->request->getBody(), true);
        //array(
        //'id_carro' => ID CARRO,
        //'id_estac' => ID ESTACIONAMENTO,
        //'vaga' => VAGA OU VAZIA,
        //'hora_reserva' => 'HH:MM:00', <===== ALWAYS ZERO
        //'hora_fim' => 'HH:MM:00', <======== ALWAYS ZERO
        //'data' => 'DD/MM/YYYY'
        //'usuario' => NOME DE USUARIO QUE ESTÁ LOGADO
        //);
        $service->vacanciesRequest($form);
    }
    else
        echo $service->openPageByAccess();
});

$app->post('/getParks', function () use ($app, $service) {
    $form = '';
    $service->getParks($form);
});

$app->post('/getCars', function () use ($app, $service) {
    $form = json_decode($app->request->getBody(), true);
    $service->getCars($form);
});

$app->post('/getModels', function () use ($app, $service) {
    $form = json_decode($app->request->getBody(), true);
    $service->getModels($form);
});

$app->get('/getMarks', function () use ($app, $service) {
    $form = '';
    $service->getMarks($form);
});

$app->get('/getUsers', function () use ($app, $service) {
    $form = '';
    $service->getUsers($form);
});

$app->post('/checkValuesRegister', function () use ($app, $service) {
    $form = json_decode($app->request->getBody(), true);
    $service->checkValuesRegister($form);
});

//http://estacionapa.com/sair
$app->get('/sair', function() use ($service) {
    echo $service->sair();
});

$app->run();

?>
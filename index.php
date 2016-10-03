<?php
//
//PROXIMAS ETAPAS
//TER MOVIMENTAÇÕES FINANCEIRAS
//
//
require 'api/vendor/autoload.php';
require 'api/vendor/vrana/NotORM.php';

require 'php/access/access.php';
require 'php/backend_manager/backend_service.php';

//chamada do framework slim
$app = new \Slim\Slim(array('debug' => true));
$service = new BackEndService;
$access = $service->getAccess();

$app->error(function (\Exception $e) use ($app) {
    $app->render('error.php');
});

// http://estacionapa.com/
$app->get('/', function() use ($service) {
    echo $service->getPage('index.html');
});

// http://estacionapa.com/login
$app->get('/login', function() use ($service) {
    echo $service->openPageByAccess();
});

// http://estacionapa.com/about
$app->get('/about', function() use ($service) {
    echo $service->getPage('html/pages/about.html');
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
    echo $service->getPage('html/forms/cad_client.html');
});

// http://estacionapa.com/register/user
$app->post('/register/client/added', function() use ($app, $service) {
    $form = json_decode($app->request->getBody(), true);
    $service->registerClient($form);
});

$app->post('/register/parks', function() use ($app, $service) {
    if(1){
        $form = json_decode($app->request->getBody(), true);
        $service->registerPark($form);
    }
    else
        echo $service->openPageByAccess();
});

// http://estacionapa.com/register/user
$app->get('/register/user', function() use ($service, $access) {
    if($access == 'a')
        echo $service->getPage('html/forms/admin_cad_users.html');

    else
        echo $service->openPageByAccess();
});

// http://estacionapa.com/register/user
$app->post('/register/user/added', function() use ($app, $service, $access) {
    if($access == 'a') {
        $form = json_decode($app->request->getBody(), true);
        $service->registerUser($form);
    }
    else
        echo $service->openPageByAccess();
});

$app->get('/register/cars', function() use ($service, $access) {
    if($access == 'a')
        echo $service->getPage('html/forms/admin_cad_cars.html');

    else
        echo $service->openPageByAccess();
});

$app->post('/register/cars/added', function() use ($app, $service, $access) {
    if($access == 'a') {
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

$app->get('/vacancies', function($board) use ($app, $service, $access) {
    if($access == 'a'){
        
    }
    else
        echo $service->openPageByAccess();
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
    if($access == 'a'){
        $form = json_decode($app->request->getBody(), true);
        //array(
        //'id_carro' => ID CARRO,
        //'id_estac' => ID ESTACIONAMENTO,
        //'vaga' => VAGA OU VAZIA,
        //'hora_reserva' => 'HH:MM:00', <===== ALWAYS ZERO
        //'hora_fim' => 'HH:MM:00', <======== ALWAYS ZERO
        //'data' => 'DD/MM/YYYY'
        //); //IDPESSOA = GET BY SESSION
        $service->vacanciesRequest($form);
    }
    else
        echo $service->openPageByAccess();
});

$app->post('/getParks', function () use ($app, $service) {
    $form = '';
    $service->getParks($form);
});

//http://estacionapa.com/sair
$app->get('/sair', function() use ($service) {
    echo $service->sair();
});

$app->run();

?>
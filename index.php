<?php

require 'api/vendor/autoload.php';
require 'php/backend_manager/backend_service.php';
require 'api/database/ConnectionFactory.php';
require 'api/people/PeopleService.php';
require 'api/license/LicenseService.php';
require 'api/vendor/vrana/NotORM.php';

//chamada do framework slim
$app = new \Slim\Slim();
$service = new BackEndService;
$access = $service->getAccess();

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
    //if($access == 'a')
        echo $service->getPage('html/forms/admin_cad_cars.html');

    //else
       // echo $service->openPageByAccess();
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

//http://estacionapa.com/sair
$app->get('/sair', function() use ($service) {
    echo $service->sair();
});

//------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------

$app->get('/api/', function() use ( $app ) {
    echo "Welcome to website ESTACIONAPA";
});

/*
ROTAS PARA BUSCA DE PESSOAS NO BANCO DE DADOS
*/
$app->get('/api/people/', function() use ( $app ) {
    $people = PeopleService::listPeople();
    $app->response()->header('Content-Type', 'application/json');
    echo json_encode($people);
});

$app->get('/api/people/:id', function($id) use ( $app ) {
    $pessoas = PeopleService::getById($id);
    
    if($pessoas) {
        $app->response()->header('Content-Type', 'application/json');
        echo json_encode($pessoas);
    }
    else {
      $app->response->setStatus('404');
      echo "People with id = $id not found";
    }
});

$app->post('/api/people/', function() use ( $app ) {
    $pessoasJson = $app->request()->getBody();
    $newPeople = json_decode($pessoasJson, true);
    if($newPeople) {
        $pessoas = PeopleService::add($newPeople);
        echo "People {$newPeople['usuario']} added";
    }
    else {
        $app->response->setStatus(400);
        echo "Malformat JSON";
    }
});

$app->put('/api/people/', function() use ( $app ) {
    $pessoasJson = $app->request()->getBody();
    $updatedPeople = json_decode($pessoasJson, true);
    
    if($updatedPeople && $updatedPeople['id']) {
        if(PeopleService::update($updatedPeople)) {
          echo "People {$updatedPeople['usuario']} updated";  
        }
        else {
          $app->response->setStatus('404');
          echo "People not found";
        }
    }
    else {
        $app->response->setStatus(400);
        echo "Malformat JSON";
    }
});

$app->delete('/api/people/:id', function($id) use ( $app ) {
    if(PeopleService::delete($id)) {
      echo "People with id = $id was deleted";
    }
    else {
      $app->response->setStatus('404');
      echo "People with id = $id not found";
    }
});

/*
ROTAS PARA BUSCA DE PLACAS NO BANCO DE DADOS
*/
$app->get('/api/license/', function() use ( $app ) {
    $license = LicenseService::listLicense();
    $app->response()->header('Content-Type', 'application/json');
    echo json_encode($license);
});

$app->get('/api/license/:id', function($id) use ( $app ) {
    $licenses = LicenseService::getById($id);
    
    if($licenses) {
        $app->response()->header('Content-Type', 'application/json');
        echo json_encode($licenses);
    }
    else {
      $app->response->setStatus('404');
      echo "License with id = $id not found";
    }
});

$app->run();




?>
<?php

require 'api/vendor/autoload.php';
require 'php/pages/pages_controller.php';
require 'api/database/ConnectionFactory.php';
require 'api/people/PeopleService.php';
require 'api/license/LicenseService.php';
require 'api/vendor/vrana/NotORM.php';

//chamada do framework slim
$app = new \Slim\Slim();
$page = new PageController;

    // http://estacionapa.com/login/index
$app->get('/', function() use ($page) {
    echo $page->getPage('index.html');
});
    
// http://estacionapa.com/login/index
$app->get('/login', function() use ($page) {
    echo $page->openPageByAccess();
});

// http://estacionapa.com/login/index
$app->get('/about', function() use ($page) {
    echo $page->getPage('html/pages/about.html');
});

$app->get('/register', function() use ($page) {
    echo $page->getPage('html/forms/cad_client.html');
});

$app->get('/register/user', function() use ($app, $page) {
    if($page->getAccess() == 'a')
        echo $page->getPage('html/forms//register/user');

    else
        echo $page->openPageByAccess();
});

$app->get('/register/cars', function() use ($app, $page) {
    if($page->getAccess() == 'a')
        echo $page->getPage('html/forms/admin_cad_cars.html');

    else
        echo $page->openPageByAccess();
});

$app->get('/edit', function() use ($app, $page) {
    if($page->getAccess() == 'a')
        echo $page->getPage('html/forms//edit');

    else
        echo $page->openPageByAccess();
});

$app->get('/delete', function() use ($app, $page) {
    if($page->getAccess() == 'a')
        echo $page->getPage('html/forms//delete');

    else
        echo $page->openPageByAccess();
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
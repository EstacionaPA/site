<?php
require 'vendor/autoload.php';
require 'database/ConnectionFactory.php';
require 'people/PeopleService.php';
require 'license/LicenseService.php';

$app = new \Slim\Slim();

$app->get('/', function() use ( $app ) {
    echo "Welcome to website ESTACIONAPA";
});

/*
ROTAS PARA BUSCA DE PESSOAS NO BANCO DE DADOS
*/
$app->get('/people/', function() use ( $app ) {
    $people = PeopleService::listPeople();
    $app->response()->header('Content-Type', 'application/json');
    echo json_encode($people);
});

$app->get('/people/:id', function($id) use ( $app ) {
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

$app->post('/people/', function() use ( $app ) {
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

$app->put('/people/', function() use ( $app ) {
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

$app->delete('/people/:id', function($id) use ( $app ) {
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
$app->get('/license/', function() use ( $app ) {
    $license = LicenseService::listLicense();
    $app->response()->header('Content-Type', 'application/json');
    echo json_encode($license);
});

$app->get('/license/:id', function($id) use ( $app ) {
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
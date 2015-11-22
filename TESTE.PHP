<?php

require 'php/backend/backend_service.php';

$page = new BackEndService;

$form = array( 
                          'name' => 'form.nome.value',
                          'user' => 'andre',
                          'pass' =>' form.senha.value',
                          'access' => 'form.acesso.value',
                          'email' => '1231231231231231',
                          'cpf' =>  'form.cpf.value',
                          'address' => 'form.endereco.value',
                          'number' => 'form.numero.value',
                          'comp' => 'form.complemento.value',
                          'cep' => 'form.cep.value',
                          'block' => 'form.bairro.value',
                          'city' => 'form.cidade.value',
                          'cel' => 'form.cel.value',
                          'state' => 'form.state.value',
                          'tel' => 'form.telefone.value');

echo $login = $page->registerUser($form);



?>
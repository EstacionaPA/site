<?php

session_start();

include_once('modo_acesso.php');

//Busca usuário na seção
$usuario = $_SESSION['usuario'];

//Realiza consulta
$sql = mysql_query("SELECT nome FROM pessoas 
                    WHERE usuario ='$usuario'");

//Retira o resultado da consulta da primeira linha "0" da consulta
$result = mysql_result($sql, 0);

//Retira a posição do primeiro espaço
$posString = strpos($result, ' ');
//Retira o primeiro nome (com a posição do primeiro espaço)
$newString = substr($result, 0, $posString);

print $newString;
		
?>
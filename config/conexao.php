<?php 

// Conexao com o banco de dados

$server = "localhost"; 
$user = "root"; 
$senha = "snake007"; 
$base = "projeto"; 
$conexao = mysql_connect($server, $user, $senha) or die("Erro na conexão!");

?>
<?php 

// Conexao com o banco de dados

$conexao = mysql_pconnect("localhost","root","snake007") or die ("Erro na conexão!");
//$conexao = mysql_pconnect("localhost","root","") or die ("Erro na conexão!");
$banco = mysql_select_db("projeto");

?>
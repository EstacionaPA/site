<?php 

include_once('../config/conexao.php');

$nome = $_POST['nome'];
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$endereco = $_POST['endereco'];
$numero = $_POST['numero'];
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];
$cep = $_POST['cep'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$telefone = $_POST['telefone'];
$celular = $_POST['celular'];
        
if (!($nome) || !($usuario) || !($senha) || !($email) || !($cpf)
	|| !($endereco) || !($numero) || !($complemento) || !($bairro) || !($cep)
	|| !($cidade) || !($estado) || !($telefone) || !($celular)){
    print "Preencha todos os campos!"; exit();
}
//Abrindo Conexao com o banco de dados
//$conexao = mysql_pconnect("localhost","root","snake007") or die (mysql_error());
//$banco = mysql_select_db("projeto");
 
$insert = mysql_query("insert into pessoas (nome ,usuario  ,senha  ,email  ,cpf ,endereco  ,
	numero  ,complemento  ,bairro  ,cep  ,cidade  ,estado ,telefone  ,celular) 
	values ('{$nome}','{$usuario}','{$senha}','{$email}','{$cpf}','{$endereco}'
		,'{$numero}','{$complemento}','{$bairro}','{$cep}','{$cidade}','{$estado}','{$telefone}','{$celular}')");

if($insert) {
    print "Cadastro Realizado!";
}else {
    print "Erro ao Cadastrar!";
}

?>
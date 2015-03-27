<?php 

include_once('../config/conexao_remoto.php');

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$celular = $_POST['celular'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];
$numero = $_POST['numero'];
$cep = $_POST['cep'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];


        
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
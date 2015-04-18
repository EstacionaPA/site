<?php 

include_once('modo_acesso.php');

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$criptografada = md5($senha);
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
    echo "<script> alert ('Preencha Todos os Campos!'); </script>";
    exit();
}
//Abrindo Conexao com o banco de dados
//$conexao = mysql_pconnect("localhost","root","snake007") or die (mysql_error());
//$banco = mysql_select_db("projeto");
 
$insert = mysql_query("insert into pessoas (nome ,usuario  ,senha  ,email  ,cpf ,endereco  ,
	numero  ,complemento  ,bairro  ,cep  ,cidade  ,estado ,telefone  ,celular) 
	values ('{$nome}','{$usuario}','{$criptografada}','{$email}','{$cpf}','{$endereco}'
		,'{$numero}','{$complemento}','{$bairro}','{$cep}','{$cidade}','{$estado}','{$telefone}','{$celular}')");

if($insert) {
    echo "<script> alert ('Cadastro Realizado!'); </script>";
}else {
    echo "<script> alert ('Erro ao Cadastrar'); </script>";
}

?>
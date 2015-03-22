<?php 

//include "../config/conexao.php";
// Verifica se existe a variável txtnome 

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
$conexao = mysql_pconnect("localhost","root","snake007") or die (mysql_error());
$banco = mysql_select_db("projeto");
 
//Utilizando o  mysql_real_escape_string voce se protege o seu código contra SQL Injection.
$nome = mysql_real_escape_string($nome);
$usuario = mysql_real_escape_string($usuario);
$senha = mysql_real_escape_string($senha);
$email = mysql_real_escape_string($email);
$cpf = mysql_real_escape_string($cpf);
$endereco = mysql_real_escape_string($endereco);
$numero = mysql_real_escape_string($numero);
$complemento = mysql_real_escape_string($complemento);
$bairro = mysql_real_escape_string($bairro);
$cep = mysql_real_escape_string($cep);
$cidade = mysql_real_escape_string($cidade);
$estado = mysql_real_escape_string($estado);
$telefone = mysql_real_escape_string($telefone);
$celular = mysql_real_escape_string($celular);

 
$insert = mysql_query("insert into pessoas (nome ,usuario  ,senha  ,email  ,cpf ,endereco  ,
	numero  ,complemento  ,bairro  ,cep  ,cidade  ,estado ,telefone  ,celular) 
	values ('{$nome}','{$usuario}','{$senha}','{$email}','{$cpf}','{$endereco}'
		,'{$numero}','{$complemento}','{$bairro}','{$cep}','{$cidade}','{$estado}','{$telefone}','{$celular}')");
mysql_close($conexao);

if($insert) {
    print "Cadastro Realizado!";
}else {
    print "Erro ao Cadastrar!";
}

?>
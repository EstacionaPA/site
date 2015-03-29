<?php 

include_once('../config/conexao_remoto.php');

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
       
if (!($usuario) || !($senha)){

    print "Preencha todos os campos!"; exit();
}

//Abrindo Conexao com o banco de dados
//$conexao = mysql_pconnect("localhost","root","snake007") or die (mysql_error());
//$banco = mysql_select_db("projeto");
 
$login = mysql_query("select usuario, senha from pessoas where usuario = {$usuario} and senha = {$senha}");

if($login) {
    print "Bem vindo!!";
}else {
    print "Usuário e/ou senha inválidos!";
}

?>

<?php

 include_once('../config/conexao_remoto.php');
 
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
 
//Consulta no banco de dados

$sql="select * from pessoas where usuario='".$usuario."' and senha='".sha1($senha)."'";

$resultados = mysql_query($sql)or die (mysql_error());

$res=mysql_fetch_array($resultados); //

if (@mysql_num_rows($resultados) == 0){
	echo 0;	//Se a consulta não retornar nada é porque as credenciais estão erradas
}

else{
	echo 1;	//Responde sucesso
	if(!isset($_SESSION)) 	//verifica se há sessão aberta
	session_start();		//Inicia seção
	//Abrindo seções
	$_SESSION['usuarioID']=$res['id']; 		
	$_SESSION['nomeUsuario']=$res['nome'];
	$_SESSION['email']=$res['email'];	
	exit;	
}
?>
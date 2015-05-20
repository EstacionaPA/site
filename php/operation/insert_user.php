<?php 

include_once('sql_central.php');

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
$acesso = 'c';
$telefone = $_POST['telefone'];
$celular = $_POST['celular'];

if (!($nome) || !($usuario) || !($senha) || !($email) || !($cpf)
	|| !($endereco) || !($numero) || !($complemento) || !($bairro) || !($cep)
	|| !($cidade) || !($estado) || !($telefone) || !($celular))
    {
        echo 2;
        return;
}
 
$insert = insertUsers($nome, $usuario, md5($senha), $email, 
                    $cpf, $endereco, $numero, $complemento, $bairro, $cep, 
                    $cidade, $estado, $telefone, $celular, $acesso);

if($insert) 
    echo '1';
else 
    echo '10';

?>
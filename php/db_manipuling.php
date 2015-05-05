<?php

function requestUser($usuario, $senhaCriptografada) {
    
        $user = "SELECT count(*) FROM pessoas 
                  WHERE( usuario ='$usuario' 
                            AND 
                         senha ='$senhaCriptografada'
                       )";
    
    return $user;

}

function insertUsers($nome, $usuario, $criptografada, $email, 
                    $cpf, $end, $num, $comp, $bairro, $cep, 
                    $cidade, $estado, $tel, $cel, $acesso) {
    
   $insert = "insert into pessoas (nome ,usuario  ,senha  ,email  ,cpf ,endereco  ,
	numero  ,complemento  ,bairro  ,cep  ,cidade  ,estado ,telefone  ,celular  ,acesso) 
	values ('{$nome}','{$usuario}','{$criptografada}','{$email}','{$cpf}','{$end}'
		,'{$num}','{$comp}','{$bairro}','{$cep}','{$cidade}','{$estado}','{$tel}','{$cel}','{$acesso}')";

    
    return  $insert;
        
}

function requestAccess($usuario) {
    
    $access = "SELECT acesso FROM pessoas
                  WHERE usuario = '$usuario'";
    
    return $access;
    
}

function resquestName($usuario) {
    
    $name = "SELECT nome FROM pessoas 
                    WHERE usuario ='$usuario'";
    
    return $name;
    
}


?>
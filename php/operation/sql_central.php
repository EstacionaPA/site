<?php

include_once('../mode_access.php');

function requestUser($usuario, $senhaCriptografada) 
{
    
    if($usuario == '' || $senhaCriptografada == '') return false;
    
    $user = "SELECT count(*) FROM pessoas 
              WHERE( usuario ='$usuario' 
                        AND 
                     senha ='$senhaCriptografada')";

    $resultUser = mysql_query($user);
    $row = mysql_fetch_array($resultUser);

    if($row[0] > 0) return 1;
    else return 2;

}

function insertUsers($nome, $usuario, $criptografada, $email, 
                    $cpf, $end, $num, $comp, $bairro, $cep, 
                    $cidade, $estado, $tel, $cel, $acesso) {

    $insert = mysql_query(
        "insert into pessoas 
        (
         nome, usuario, senha, email, cpf, endereco, 
         numero, complemento, bairro, cep, cidade, estado, telefone, celular, acesso
        ) 
        values
        (
            '{$nome}','{$usuario}','{$criptografada}',
            '{$email}','{$cpf}','{$end}','{$num}','{$comp}',
            '{$bairro}','{$cep}','{$cidade}','{$estado}','{$tel}',
            '{$cel}','{$acesso}'
        )"
    );
    
    if($insert) 
        return '1';
    else 
        return '10';
}

function requestAccess($usuario) {
    
    $access = "SELECT acesso FROM pessoas
                  WHERE usuario = '$usuario'";
    
    $resultAccess = mysql_query($access);
    $stringResult = mysql_result($resultAccess, 0);
    
    return $stringResult;
    
}

function resquestName($usuario) {
    
    $name = "SELECT nome FROM pessoas 
                    WHERE usuario ='$usuario'";
    
    return $name;
    
}


?>
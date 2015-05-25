<?php

include_once('../../config/bd_connection/conexao_remoto.php');


function requestUser($usuario, $senhaCriptografada) 
{
    
    if($usuario == '' || $senhaCriptografada == '') return false;
    
    $user = "SELECT count(*) FROM pessoas 
              WHERE( usuario ='$usuario' 
                        AND 
                     senha ='$senhaCriptografada')";

    $resultUser = mysql_query($user);
    $row = mysql_fetch_array($resultUser);

    if($row[0] > 0) return "existe";
    else return "no";

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

function updateUser($user, $column, $valueColumn){
    
    $update = "UPDATE pessoas SET " . $column . " = '$valueColumn' WHERE usuario = '$user';";
    $valid = mysql_query($update);

    return $valid;
}

function checkUser($user){
        
    $checkUser = "SELECT count(*) FROM pessoas 
              WHERE usuario = '$user'";

    $resultUser = mysql_query($checkUser);
    $row = mysql_fetch_array($resultUser);
    
    if($row[0] > 0) return "existe";
    else return "nao existe";
}

function deletUser($user){
    
    $delet = "DELETE FROM pessoas WHERE usuario = '$user';";
    
    $valid = mysql_query($delet);
    
    if($valid==1)
        return "ok";
    else
        return mysql_error();
 
}
?>
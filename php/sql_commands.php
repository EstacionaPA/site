<?php

include_once('../../config/bd_connection/conexao_remoto.php');

//Realiza a confirmação se usuário e senhas estão válidos
function requestUser($usuario, $senhaCriptografada) 
{
    
    if($usuario == '' || $senhaCriptografada == '') return false;
    
    $user = "SELECT count(*) FROM pessoas 
              WHERE( usuario ='$usuario' 
                        AND 
                     senha ='$senhaCriptografada')";
    
    //envia o comando ao SQL
    $resultUser = mysql_query($user);
    
    //transforma a retorno da consulta em um array
    $row = mysql_fetch_array($resultUser);

    //se existir a primeira posição do array
    if($row[0] > 0) return "existe";
    else return "no";

}

//Registra os dados de cadastro de um novo usuário
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

//Requisita o nível de acesso de um determinado usuário
function requestAccess($usuario) {
    
    $access = "SELECT acesso FROM pessoas
                  WHERE usuario = '$usuario'";
    
    $resultAccess = mysql_query($access);
    $stringResult = mysql_result($resultAccess, 0);
    
    return $stringResult;
    
}

//Requisita o nome de um determinado usuário
function requestName($usuario) {
    
    $sql = "SELECT nome, celular, endereco FROM pessoas 
                    WHERE usuario ='$usuario'";
    
    $nome = mysql_query($sql);
    $nomeResult = mysql_result($nome, 0, 0);
    
    return $nomeResult . mysql_error();
    
}

//Registra os dados de um usuário alterados pelo admin
function updateUser($user, $column, $valueColumn){
    
    $update = "UPDATE pessoas SET " . $column . " = '$valueColumn' WHERE usuario = '$user';";
    $valid = mysql_query($update);

    return $valid;
}

//Checa se somente o usuário existe
function checkUser($user){
        
    $sql = "SELECT count(*) FROM pessoas 
              WHERE usuario = '$user'";

    $resultUser = mysql_query($sql);
    $row = mysql_fetch_array($resultUser);
    
    //
    if($row[0] > 0) return "existe";
    else return "nao existe";
}

//Função para checar PLACA
function checkPlaca($placa){
    
    $sql = "SELECT count(*) FROM carro
              WHERE placa = '$placa'";

    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    
    //
    if($row[0] > 0) return "existe";
    else return "nao existe";
    
}

//Função para checar a marca
function checkMarca($marca){
    $sql = "SELECT count(*) FROM marca
              WHERE nome = '$marca'";

    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    
    //
    if($row[0] > 0) return "existe";
    else return "nao existe";
}

//Função para checar o modelo
function checkModelo($mod){
    $sql = "SELECT count(*) FROM modelo
              WHERE nome = '$mod'";

    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    
    //
    if($row[0] > 0) return "existe";
    else return "nao existe";
}

//Função de deletar um determinado usuário
function deletUser($user){
    
    $sql = "DELETE FROM pessoas WHERE usuario = '$user';";

    $delet = mysql_query($sql);
    
    if($delet==1)
        return "ok";
    else
        return mysql_error();
 
}

//Realiza a consulta de informações de um determinado usuário
function relatInfUser($name){
    
    $sql =   
        "select p.nome, p.celular, p.cidade, c.placa, ma.nome as marca, 
                mo.nome as modelo
        from carro  c
        join pessoas p on c.pessoas_id = p.id
        join marca ma on ma.id = c.marca_id
        join modelo mo on mo.id = c.modelo_id
        where p.nome like '%$name%';";
        
        $relatInfUser = mysql_query($sql);
    
        return $relatInfUser;
}

function registerCar($user, $placa, $marca, $mod){
    
    $sql = "INSERT INTO carro
            (placa, marca_id, pessoas_id, modelo_id)
            values
            ('{$placa}', '{$marca}', '{$user}', '{$mod}')";
        
    $insert = mysql_query($sql);
    return $insert . mysql_error();
    
    $relatInfUser = mysql_query($sql);
    $result = mysql_fetch_array($relatInfUser);

    return $result;
}

?>
<?php

include_once('../../config/bd_connection/conexao_remoto.php');

//------------------------REQUISIÇÕES--------------------------

//Requisita o nível de acesso de um determinado usuário
function requestAccess($usuario) {
    
    $sql = "SELECT acesso FROM pessoas
                  WHERE usuario = '$usuario'";
    
    $query = mysql_query($sql);
    $result = mysql_result($query, 0);
    
    return $result;
    
}

//Requisita o ID do usuario
function requestIDUser($user){
    
    $sql = "SELECT id FROM pessoas
            WHERE usuario = '$user';";
    
    $query = mysql_query($sql);
    $result = mysql_result($query, 0);
    
    return $result;
    
}

//Requisita o ID da marca
function requestIDMarca($marca){
    
    $sql = "SELECT id FROM marca
            WHERE nome = '$marca';";
    
    $query = mysql_query($sql);
    $result = mysql_result($query, 0);
    
    return $result;
}

//Requisita o ID do modelo
function requestIDModelo($mod){
    
    $sql = "SELECT id FROM modelo
            WHERE nome = '$mod';";
    
    $query = mysql_query($sql);
    $result = mysql_result($query, 0);
    
    return $result;
}

//Requisita o nome de um determinado usuário
function requestName($usuario) {
    
    $sql = "SELECT nome FROM pessoas 
            WHERE usuario ='$usuario'";

    $query = mysql_query($sql);
    $result = mysql_result($query, 0);
    
    return $result;
    
}

//Requisita todas as marcas de carros existentes no banco de dados
function requestMark(){
    
    $sql = "SELECT nome FROM marca
            ORDER BY nome;";
    
    $query = mysql_query($sql);
    return $query;    
    
}

//Requisita todos os modelos de carros existentes no banco de dados
function requestModel($markValue){
    
    $idMark = requestIDMarca($markValue);
    
    $sql = "SELECT nome FROM modelo
            WHERE marca_id = $idMark
            ORDER BY nome;";
    
    $query = mysql_query($sql);
    return $query;
    
}

//--------------------------INSERTS--------------------------

//Registra os dados de cadastro de um usuário
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

//Requista os dados do cadastro de um carro
function insertCar($user, $placa, $marca, $mod){
    
    $sql = "INSERT INTO carro
            (placa, marca_id, pessoas_id, modelo_id)
            values
            ('{$placa}', '{$marca}', '{$user}', '{$mod}')";
        
    $insert = mysql_query($sql);
    return $insert . mysql_error();
}
    
//--------------------------UPDATE--------------------------

//Registra os dados de um usuário alterados pelo admin
function updateUser($user, $column, $valueColumn){
    
    $update = "UPDATE pessoas SET " . $column . " = '$valueColumn' WHERE usuario = '$user';";
    $valid = mysql_query($update);

    return $valid;
}

//--------------------------DELETE --------------------------

//Função de deletar um determinado usuário
function deletUser($user){
    
    $sql = "DELETE FROM pessoas WHERE usuario = '$user';";
     
    $delet = mysql_query($sql);
    
    if($delet==1)
        return "ok";
    else
        return mysql_error();
 
}

//--------------------------VALIDAÇÕES--------------------------

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

//Realiza a confirmação se usuário e senhas estão válidos
function checkUserPass($usuario, $senhaCriptografada) 
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

//--------------------------RELATORIOS--------------

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


//Realiza a consulta de carros por placa
function relatBordXCar($board){
    
    $sql = "SELECT p.nome, p.telefone, ma.nome, mo.nome
            FROM carro c
            JOIN pessoas p ON p.id = c.pessoas_id
            JOIN modelo mo on mo.id = c.modelo_id
            JOIN marca ma on ma.id = c.marca_id
            WHERE c.placa = '$board';";
    
    $relatBoardXCar = mysql_query($sql);
    
    return $relatBoardXCar;
        
}

// Realiza a consulta de clientes por estado
function relatgraf (){
    $sql = "SELECT count(*), p.estado
            FROM pessoas p
            GROUP BY p.estado";
        
    $relatgraf = mysql_query($sql);
        
    return $relatgraf;
}
?>
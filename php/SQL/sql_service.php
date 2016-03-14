<?php

require 'connection.php';

class SQLService {
    
    public static function connect(){
        $conn = new Connection;
        $mysqli = $conn->Conn('localServer');
        return $mysqli;
    }
    
    //
    //--------------EXECUTE AND SENDS THE MYSQL QUERIES
    //
    
    public function validateSQLExecutes($result, $insert){
         if(($result[0] > 0 and $insert=='no')
                            or 
            ($result==1 and $insert=='yes'))
                return 'done';
        else
            return 'dont';
    }
    
    public function ExecuteSQL($query, $type){

        $db = self::connect();
        
        if(!$db) return NULL;
        
        $resultQuery = $db->query($query);
        
        if($resultQuery){
            
            if($type == 'getArray') 
                $result = $resultQuery->fetch_assoc();
            
            elseif($type == 'getArrayList'){
                while($rows = $resultQuery->fetch_array(MYSQLI_BOTH)){
                    $result[] = $rows;
                }
            }
            
            elseif($type == 'checkValue') 
                return self::validateSQLExecutes($resultQuery->fetch_row(), 'no');
            
            elseif($type == 'OnlyExecute') 
                return self::validateSQLExecutes($resultQuery, 'yes');
            
            else {
                echo 'Opcao de servico de SQL invalida. Contacte um suporte!';
                return NULL;
            }
               
                
                //if (!$db->query("SET @a:='this will not work'")) 
                    //printf("Error: %s\n", $db->error);
                
        }else {
            echo 'Erro de MySQL: ' . $db->error . '.';
            return NULL;
        } 
        
        $db->close();
        
        return $result;
    }
    
    public function mySqlFechArray($query){
        
        return "teste";
        /*
        $result = mysqli_query($query);
        $row = mysqli_fetch_array($result);
        return $row[0];
        */
    }
    
    //
    //--------------BUILDS THE QUERIES
    //
    
    public function BuildSelectFromWhereOrder($fieldToSelect, $table, $fieldToFilter, $filter, $orderBy) {
        
        $query = "SELECT $fieldToSelect 
                  FROM $table
                  WHERE $fieldToFilter = $filter
                  ORDER BY $orderBy;";
        
        return $query;
        
    }   
    
    public function BuildSelectFromWhere($fieldToSelect, $table, $fieldToFilter, $filter){
        
        $query = "SELECT $fieldToSelect 
                  FROM $table
                  WHERE $fieldToFilter = '$filter';";
                
        return $query;
    }
    
    public function BuildSelectCountFromWhere($table, $fieldToFilter, $filter){
            
        $sql = "SELECT count(*) 
                FROM $table 
                WHERE $fieldToFilter = '$filter';";
    
        return $sql;
    }
    
    //operation/insert_user.php
    public function BuildSqlInsertUsers($nome, $usuario, $criptografada, $email, 
                                               $cpf, $end, $num, $comp, $bairro, $cep, 
                                               $cidade, $estado, $tel, $cel, $acesso) {
    
        $sql =  "INSERT INTO pessoas (
                    nome, usuario, senha, email, cpf, endereco, 
                    numero, complemento, bairro, cep, cidade, estado, telefone, celular, acesso
                ) 
                VALUES (
                    '{$nome}','{$usuario}','{$criptografada}',
                    '{$email}','{$cpf}','{$end}','{$num}','{$comp}',
                    '{$bairro}','{$cep}','{$cidade}','{$estado}','{$tel}',
                    '{$cel}','{$acesso}'
                )";
                
        return $sql;
    }
    
    //operation/cad_cars.php
    public function BuildSqlInsertCar($user, $placa, $marca, $mod){
        
        
        $sql = "INSERT INTO carro
                (placa, marca_id, pessoas_id, modelo_id)
                values
                ('{$placa}', '{$marca}', '{$user}', '{$mod}')";
            
        return $sql;
    }
    
    public function BuildSqlUpdateSingleValue($table, $column, $value, $fieldToFilter, $filter){
        
        $sql = "UPDATE $table
                SET $column = '$value' 
                WHERE $fieldToFilter = '$filter';";
                
        return $sql;
    }
    
    public function BuildSqlInactivePerson($user, $cause){
        
        $sql = "INSERT INTO inactive
                (user, cause)
                values
                ('{$user}', '{$cause}');";

        return $sql;
        
    }
    
    
    //
    //--------------REPORTS
    //
    
    
    //Realiza a consulta de informações de um determinado usuário
    //operation/relat_inf_user.php
    public function relatInfUser($name){
        
        $sql =   
            "select p.nome, p.celular, p.cidade, c.placa, ma.nome as 'marca', 
                    mo.nome as 'modelo'
            from carro  c
            join pessoas p on c.pessoas_id = p.id
            join marca ma on ma.id = c.marca_id
            join modelo mo on mo.id = c.modelo_id
            where p.nome like '%$name%';";
            
            return $sql;
    }
    
    
    //Realiza a consulta de carros por placa
    //operation/relat_boardXcar.php
    public function relatBoardXCar($board){
        
        $sql = "SELECT p.nome as 'nome', p.telefone, ma.nome as 'marca' , mo.nome as 'modelo'
                FROM carro c
                JOIN pessoas p ON p.id = c.pessoas_id
                JOIN modelo mo on mo.id = c.modelo_id
                JOIN marca ma on ma.id = c.marca_id
                WHERE c.placa = '$board';";
        
        return $sql;
            
    }
    
}
?>

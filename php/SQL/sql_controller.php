<?php

/*
PARA REALIZAR!!

1) RESTRUTURAR A METODOLOGIA DE REQUISIÇÕES DE BD 
    EM ANDAMENTO{
        2) REQUESTS
    }
    
    PARA REALIZAR{
        3) INSERTS
    }
    TERMINADOS
        1) CONEÇÃO
    }
2) METODOLOGIA DE TRATAMENTO DE ERROS
2) REFAZER A CONECÇÃO DOS ARQUIVOS JS COM OS ARQUIVOS PHP
3) 
*/

require 'connection.php';
require 'sql_services.php';

class SqlController {
    
    public static function init() {
        SqlController::connect();
    }
    
    public static function connect(){
        $conn = new Connection;
        $conn->Conn('remoto');
    }

    //
    //REQUESTS
    //

    public static function Request($type, $var){
        
        //Realize a query to request a determinate value, from determinate filter
        
        $sql = new SQLService;

        //login/valid_access.php
        if($type == 'RequestAccess'){
            
            $validateUser = SqlController::Validate('CheckUser', $var);
            if($validateUser == 'invalido') return 'nullUserPass';
            
            $query = $sql->BuildSelecFromWhere('acesso', 'pessoas', 'usuario', $var);
        }
        
        //login/name_user.php
        elseif($type == 'RequestName') 
            $query = $sql->BuildSelecFromWhere('acesso', 'pessoas', 'usuario', $var);
        
        //operation/cad_cars.php
        elseif($type == 'RequestIdUser') 
            $query = $sql->BuildSelecFromWhere('id', 'pessoas', 'usuario', $var);
        
        //operation/cad_cars.php
        elseif($type == 'RequestIdModel') 
            $query = $sql->BuildSelecFromWhere('id', 'modelo', 'nome', $var);
        
        //operation/cad_cars.php
        elseif($type == 'RequestIdMark') 
            $query = $sql->BuildSelecFromWhere('id', 'marca', 'nome', $var);
         
        return $sql->mySqlResult($query);   
    }
    
    //
    //VALIDATE
    //
    
    public static function Validate($type, $toCheck){
        
        //Realize a query for validate if that variable ($toCheck) is valid
        
        $sql = new SQLService;
        
        //this::request('requestAccess') & operation/cad_cars.php
        if($type == 'CheckUser') 
            $query = $sql->BuildSelectCountWhere('pessoas', 'usuario', $toCheck);

        elseif($type == 'CheckPass') 
            $query = $sql->BuildSelectCountWhere('pessoas', 'senha', md5($toCheck));

        //operation/cad_cars.php
        elseif($type == 'CheckMark')
            $query = $sql->BuildSelectCountWhere('marca', 'nome', $toCheck);

        //operation/cad_cars.php
        elseif($type == 'CheckModel') 
            $query = $sql->BuildSelectCountWhere('modelo', 'nome', $toCheck);
        
        //operation/cad_cars.php
        elseif($type == 'CheckBoard') 
            $query = $sql->BuildSelectCountWhere('carro', 'placa', $toCheck);
            
        $result = $sql->mySqlFechArray($query);
        return $sql->validateSQLExecutes($result, 'no');
    }
    
    
    
    public static function Insert($type, $objct){
        
        if($type = 'insertCar'){
            $command = SQLService::BuildInsertCar($objct->getIdUser(), $objct->getBoard(),$objct->getMark(), $objct->getModel());
            $exeCmmd = SQLService::OnlySendQuery($command);
            
            return $validate;
        }
    }
    public static function Update(){
    }
    public static function Delet(){
    }
}

SqlController::init();
?>
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
require 'sql_service.php';

class SqlController {
    
    public static function init() {
        SqlController::connect();
    }
    
    private static function connect(){
        $conn = new Connection;
        $conn->Conn('local');
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
    //VALIDATES
    //
    
    public static function Validate($type, $toCheck){
        
        //Realize a query for validate if that variable ($toCheck) is valid
        
        $sql = new SQLService;
        
        //self::request('requestAccess') & operation/cad_cars & account_mananger/register_person
        if($type == 'CheckUser') 
            $query = $sql->BuildSelectCountWhere('pessoas', 'usuario', $toCheck);
            
        //account_mananger/register_person
        elseif($type == 'CheckPass') 
            $query = $sql->BuildSelectCountWhere('pessoas', 'senha', md5($toCheck));
        
        //account_mananger/register_person    
        elseif($type == 'CheckEmail') 
            $query = $sql->BuildSelectCountWhere('pessoas', 'email', $toCheck);
          
        //account_mananger/register_person  
        elseif($type == 'CheckCPF') 
            $query = $sql->BuildSelectCountWhere('pessoas', 'cpf', $toCheck);

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
    
    //
    //INSERTS
    //
    
    public static function Insert($type, $obj){
        
        
        if($type == 'insertCar'){
           // $command = SQLService::BuildSqlInsertCar($obj->getIdUser(), $obj->getBoard(),$obj->getMark(), $obj->getModel());
            //$exeCmmd = SQLService::OnlySendQuery($command);
            
            return $validate;
        }

        //account_mananger/register_person
        elseif($type == 'registerPerson'){
            
            $command = SQLService::BuildSqlInsertUsers($obj->name, $obj->user, $obj->pass, $obj->email, $obj->cpf, $obj->address, $obj->number, 
                                                        $obj->comp, $obj->block, $obj->cep, $obj->city, $obj->state, $obj->tel, $obj->cel,
                                                        $obj->access);

            $exeCmmd = SQLService::onlySendQuery($command);
            
            return $exeCmmd;
        }
    }
    public static function Update(){
    }
    public static function Delet(){
    }
}

SqlController::init();
?>
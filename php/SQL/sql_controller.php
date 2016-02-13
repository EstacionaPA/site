<?php

require 'connection.php';
require 'sql_service.php';

class SqlController {

    public static function init() {
        SqlController::connect();
    }

    private static function connect(){
        $conn = new Connection;
        $conn->Conn('localServer');
    }
    //
    //REQUESTS
    //

    public static function Request($type, $var){

        //Realize a query to request a determinate value, from determinate filter
        //RequestMarks and RequestModels has other return type***
        $sql = new SQLService;

        //login/valid_access.php
        if($type == 'RequestAccess'){

            $validateUser = SqlController::Validate('CheckUser', $var);
            if($validateUser == 'invalido') return 'nullUserPass';

            $query = $sql->BuildSelectFromWhere('acesso', 'pessoas', 'usuario', $var);
        }

        //login/name_user.php
        elseif($type == 'RequestName')
            $query = $sql->BuildSelectFromWhere('acesso', 'pessoas', 'usuario', $var);

        //operation/cad_cars.php
        elseif($type == 'RequestIdUser')
            $query = $sql->BuildSelectFromWhere('id', 'pessoas', 'usuario', $var);

        //operation/cad_cars.php
        elseif($type == 'RequestIdModel')
            $query = $sql->BuildSelectFromWhere('id', 'modelo', 'nome', $var);

        //operation/cad_cars.php
        elseif($type == 'RequestIdMark')
            $query = $sql->BuildSelectFromWhere('id', 'marca', 'nome', $var);

        //operation/cad_cars.php
        //OTHER RETURN TYPE***
        elseif($type == 'RequestMarks'){                            //THIS IS TO SEND A NULL SQL CONDITION (WHERE 1 = '1')
            $query = $sql->BuildSelectFromWhereOrder('nome', 'marca', 1, 1 ,'nome');
            return SQLService::onlySendQuery($query);
        }

        //operation/cad_cars.php
        //OTHER RETURN TYPE***
        elseif($type == 'RequestModels') {
            $query = $sql->BuildSelectFromWhereOrder('nome', 'modelo', 'marca_id', $var, 'nome');
            return SQLService::onlySendQuery($query);
        }

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
            $query = $sql->BuildSelectCountFromWhere('pessoas', 'usuario', $toCheck);

        //account_mananger/register_person
        elseif($type == 'CheckPass')
            $query = $sql->BuildSelectCountFromWhere('pessoas', 'senha', md5($toCheck));

        //account_mananger/register_person
        elseif($type == 'CheckEmail')
            $query = $sql->BuildSelectCountFromWhere('pessoas', 'email', $toCheck);

        //account_mananger/register_person
        elseif($type == 'CheckCPF')
            $query = $sql->BuildSelectCountFromWhere('pessoas', 'cpf', $toCheck);

        //operation/cad_cars.php
        elseif($type == 'CheckMark')
            $query = $sql->BuildSelectCountFromWhere('marca', 'nome', $toCheck);

        //operation/cad_cars.php
        elseif($type == 'CheckModel')
            $query = $sql->BuildSelectCountFromWhere('modelo', 'nome', $toCheck);

        //operation/cad_cars.php
        elseif($type == 'CheckBoard')
            $query = $sql->BuildSelectCountFromWhere('carro', 'placa', $toCheck);

        //login/login_service & account_manager/manager_service
        elseif($type == 'CheckInactive')
            $query = $sql->BuildSelectCountFromWhere('inactive', 'user', $toCheck);

        $result = $sql->mySqlFechArray($query);
        return $sql->validateSQLExecutes($result, 'no');
    }

    //
    //INSERTS
    //

    public static function Insert($type, $obj){

        //operation/cad_cars.php
        if($type == 'insertCar')
            $command = SQLService::BuildSqlInsertCar($obj->getUser(), $obj->getBoard(),$obj->getMark(), $obj->getModel());

        //account_mananger/register_person
        elseif($type == 'registerPerson')
            $command = SQLService::BuildSqlInsertUsers($obj['name'], $obj['user'], $obj['pass'], 
                                                       $obj['email'], $obj['cpf'], $obj['address'],  
                                                       $obj['number'], $obj['comp'], $obj['block'], 
                                                       $obj['cep'], $obj['city'], $obj['state'], 
                                                       $obj['tel'], $obj['cel'], $obj['access']);

        elseif($type == 'InactivePerson')
            $command = SQLService::BuildSqlInactivePerson($obj['user'], $obj['cause']);


        $exeCmmd = SQLService::onlySendQuery($command);
        return $exeCmmd;

    }

    //
    //UPDATES
    //


    public static function Update($type, $obj){

        if($type =='UpdateUser')
            $sql = SQLService::BuildSqlUpdateSingleValue('pessoas', $obj['column'], $obj['value'], 'usuario', $obj['user']);
            //return $sql;

        $exeCmmd = SQLService::OnlySendQuery($sql);

        return SQLService::validateSQLExecutes($exeCmmd, 'no');
    }

    public static function Delet(){
    }

    //
    //REPORTS
    //

    public static function Report($type, $obj){

        if($type == 'BoardXCar')
            $report = SQLService::relatBoardXCar($obj);

        elseif($type == 'InfUser')
            $report = SQLService::relatInfUser($obj);

        return $report;

    }
}

SqlController::init();
?>
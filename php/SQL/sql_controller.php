<?php

require 'sql_service.php';

class SqlController {

    //
    //REQUESTS
    //

    public static function Request($type, $var){

        //Realize a query to request a determinate value, from determinate filter
        $sql = new SQLService;

        //login/valid_access.php
        if($type == 'RequestAccess'){

            //$validateUser = SqlController::Validate('CheckUser', $var);
            //if($validateUser == 'invalido') return 'nullUserPass';
            $query = $sql->BuildSelectFromWhere('acesso', 'pessoas', 'usuario', $var);
            $result = $sql->ExecuteSQL($query, 'getArray');
            return $result['acesso'];
        }

        //login/name_user.php
        elseif($type == 'RequestName'){
            $query = $sql->BuildSelectFromWhere('nome', 'pessoas', 'usuario', $var);
            $result = $sql->ExecuteSQL($query, 'getArray');
            return $result['nome'];
        }

        //operation/cad_cars.php
        elseif($type == 'RequestIdUser'){
            $query = $sql->BuildSelectFromWhere('id', 'pessoas', 'usuario', $var);
            $result = $sql->ExecuteSQL($query, 'getArray');
            return $result['id'];
        }

        //operation/cad_cars.php
        elseif($type == 'RequestIdModel'){
            $query = $sql->BuildSelectFromWhere('id', 'modelo', 'nome', $var);
            $result = $sql->ExecuteSQL($query, 'getArray');
            return $result['id'];
        }

        //operation/cad_cars.php
        elseif($type == 'RequestIdMark'){
            $query = $sql->BuildSelectFromWhere('id', 'marca', 'nome', $var);
            $result = $sql->ExecuteSQL($query, 'getArray');
            return $result['id'];
        }

        //operation/cad_cars_values_option.php
        elseif($type == 'RequestMarks'){                            //THIS IS TO SEND A NULL SQL CONDITION (WHERE 1 = '1')
            $query = $sql->BuildSelectFromWhereOrder('nome', 'marca', 1, 1 ,'nome');
            $result = $sql->ExecuteSQL($query, 'getArrayList');
            return $result;
        }

        //operation/cad_cars_values_option.php
        elseif($type == 'RequestModels') {
            $query = $sql->BuildSelectFromWhereOrder('nome', 'modelo', 'marca_id', $var, 'nome');
            $result = $sql->ExecuteSQL($query, 'getArrayList');
            return $result;
        }
        
        else
            echo 'Opcao de Controle de SQL inválida. Contacte o suporte!';
    }

    //
    //VALIDATES
    //

    public static function Validate($type, $toCheck){

        //Realize a query for validate if that variable ($toCheck) is valid

        $sql = new SQLService;

        //self::request('requestAccess') & operation/cad_cars & account_mananger/register_person
        if($type == 'CheckUser'){
            $query = $sql->BuildSelectCountFromWhere('pessoas', 'usuario', $toCheck);
            $result = $sql->ExecuteSQL($query, 'checkValue');
            return $result;
        }

        //account_mananger/register_person
        elseif($type == 'CheckPass'){
            $query = $sql->BuildSelectCountFromWhere('pessoas', 'senha', md5($toCheck));
            $result = $sql->ExecuteSQL($query, 'checkValue');
            return $result;
        }
        
        //account_mananger/register_person
        elseif($type == 'CheckEmail'){
            $query = $sql->BuildSelectCountFromWhere('pessoas', 'email', $toCheck);
            $result = $sql->ExecuteSQL($query, 'checkValue');
            return $result;
        }

        //account_mananger/register_person
        elseif($type == 'CheckCPF'){
            $query = $sql->BuildSelectCountFromWhere('pessoas', 'cpf', $toCheck);
            $result = $sql->ExecuteSQL($query, 'checkValue');
            return $result;
        }

        //operation/cad_cars.php
        elseif($type == 'CheckMark'){
            $query = $sql->BuildSelectCountFromWhere('marca', 'nome', $toCheck);
            $result = $sql->ExecuteSQL($query, 'checkValue');
            return $result;
        }

        //operation/cad_cars.php
        elseif($type == 'CheckModel'){
            $query = $sql->BuildSelectCountFromWhere('modelo', 'nome', $toCheck);
            $result = $sql->ExecuteSQL($query, 'checkValue');
            return $result;
        }

        //operation/cad_cars.php
        elseif($type == 'CheckBoard'){
            $query = $sql->BuildSelectCountFromWhere('carro', 'placa', $toCheck);
            $result = $sql->ExecuteSQL($query, 'checkValue');
            return $result;
        }

        //login/login_service & account_manager/manager_service
        elseif($type == 'CheckInactive'){
            $query = $sql->BuildSelectCountFromWhere('inactive', 'user', $toCheck);
            $result = $sql->ExecuteSQL($query, 'checkValue');
            return $result;
        }
        
        else
            echo 'Opcao de Controle de SQL inválida. Contacte um suporte!';
        
        echo NULL;
            
    }

    //
    //INSERTS
    //

    public static function Insert($type, $obj){
        
        $sql = new SQLService;

        //operation/cad_cars.php
        if($type == 'insertCar'){
            $query = $sql->BuildSqlInsertCar($obj->getUser(), $obj->getBoard(),$obj->getMark(), $obj->getModel());
            $result = $sql->ExecuteSQL($query, 'OnlyExecute');
            return $result;
        }

        //account_mananger/register_person
        elseif($type == 'registerPerson'){
            $query = $sql->BuildSqlInsertUsers($obj['name'], $obj['user'], $obj['pass'], 
                                                       $obj['email'], $obj['cpf'], $obj['address'],  
                                                       $obj['number'], $obj['comp'], $obj['block'], 
                                                       $obj['cep'], $obj['city'], $obj['state'], 
                                                       $obj['tel'], $obj['cel'], $obj['access']);
            $result = $sql->ExecuteSQL($query, 'OnlyExecute');
            return $result;
        }

        elseif($type == 'InactivePerson'){
            $query = $sql->BuildSqlInactivePerson($obj['user'], $obj['cause']);
            $result = $sql->ExecuteSQL($query, 'OnlyExecute');
            return $result;
        }

        
        else
            echo 'Opcao de Controle de SQL inválida. Contacte um suporte!';


    }

    //
    //UPDATES
    //


    public static function Update($type, $obj){
        
        $sql = new SQLService;

        if($type =='UpdateUser'){
            $query = SQLService::BuildSqlUpdateSingleValue('pessoas', $obj['column'], $obj['value'], 'usuario', $obj['user']);
            $result = $sql->ExecuteSQL($query, 'OnlyExecute');
            return $result;
        }
            
        else
            echo 'Opcao de Controle de SQL inválida. Contacte um suporte!';
    }

    public static function Delet(){
    }

    //
    //REPORTS
    //

    public static function Report($type, $obj){
        
        $sql = new SQLService;

        if($type == 'BoardXCar'){
            $query = $sql->relatBoardXCar($obj);
            $result = $sql->ExecuteSQL($query, 'getArrayList');
            return $result;
        }

        elseif($type == 'InfUser'){
            $query = $sql->relatInfUser($obj);
            $result = $sql->ExecuteSQL($query, 'getArrayList');
            return $result;
        }
            
        else
            echo 'Opcao de Controle de SQL inválida. Contacte um suporte!';

        return NULL;

    }
}

?>
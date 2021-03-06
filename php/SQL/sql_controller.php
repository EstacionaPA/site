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

        //login/name_user.php && php/backend_manager/backend_service.php
        elseif($type == 'RequestName'){
            $query = $sql->BuildSelectFromWhere('nome', 'pessoas', 'usuario', $var);
            $result = $sql->ExecuteSQL($query, 'getArray');
            return $result['nome'];
        }

        //operation/cad_cars.php && vacancies/vacancies_request.php && operation/get_cars.php
        elseif($type == 'RequestIdUser'){
            $query = $sql->BuildSelectFromWhere('id', 'pessoas', 'usuario', $var);
            $result = $sql->ExecuteSQL($query, 'getArray');
            return $result['id'];
        }

        elseif($type == 'RequestIdEst'){
            $query = $sql->Select('e.id');
            $query = $sql->From($query, 'pessoas p');
            $query = $sql->LeftOuterJoin($query, 'estacionamentos e', 'e.id = p.id_estac');
            $query = $sql->Where($query, 'p.usuario = "' . $var . '"');
            $result = $sql->ExecuteSQL($query, 'getArray');
            return $result['id'];
        }

        elseif($type == 'RequestUsersAdmin'){
            $query = $sql->Select('p.usuario, p.nome');
            $query = $sql->From($query, 'pessoas p');
            $query = $sql->Where($query, 'p.id_estac = "' . $var . '" OR ' . 
                                         'p.id_estac = "c"');
            $result = $sql->ExecuteSQL($query, 'getArrayList');
            return $result;
        }

        elseif($type == 'RequestBoardsAdmin'){
            $query = $sql->Select('c.placa');
            $query = $sql->From($query, 'pessoas p');
            $query = $sql->RightOuterJoin($query, 'carro c', 'p.id = c.pessoas_id');  
            $query = $sql->Where($query, 'p.id_estac = "' . $var . '" OR ' . 
                                         'p.id_estac = "c" AND ' . 
                                         'c.id is not null');
            //echo $query;
            $result = $sql->ExecuteSQL($query, 'getArrayList');
            return $result;
        }

        elseif($type == 'RequestUsers'){
            $query = $sql->Select('p.usuario, p.nome');
            $query = $sql->From($query, 'pessoas p');
            $result = $sql->ExecuteSQL($query, 'getArrayList');
            return $result;
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
        elseif($type == 'RequestMarks'){
            $query = $sql->Select('m.id,
                                   m.nome');
            $query = $sql->From($query, 'marca m');
            $result = $sql->ExecuteSQL($query, 'getArrayList');
            return $result;
        }

        //operation/cad_cars_values_option.php
        elseif($type == 'RequestModels') {
            $query = $sql->Select('m.id,
                                   m.nome');
            $query = $sql->From($query, 'modelo m');
            $query = $sql->Where($query, 'm.marca_id = ' . $var['idMarca']);
            $result = $sql->ExecuteSQL($query, 'getArrayList');
            return $result;
        }
        
        //vacancies/vacancies_service.php
        elseif($type == 'RequestReserves') {
            $query = $sql->Select('*');
            $query = $sql->From($query, 'reservas r');
            $query = $sql->Where($query, 'r.data = "' . $var['data'] . '"
                                          AND
                                          r.id_estac = ' . $var['id_estac'] . ' ' . 
                                          'AND 
                                          r.vaga = ' . $var['vaga'] . ' ' . 
                                          'AND 
                                          r.status <> "L"');
            $result = $sql->ExecuteSQL($query, 'getArrayList');
            return $result;
        }

        //vacancies/vacancies_service.php
        elseif($type == 'RequestRestReserves') {
            $query = $sql->Select('*');
            $query = $sql->From($query, 'reservas r');
            $query = $sql->Where($query, 'r.data = "' . $var['data'] . '"
                                          AND
                                          r.id_estac = ' . $var['id_estac']);
            $result = $sql->ExecuteSQL($query, 'getArrayList');
            return $result;
        }
        
        //operation/get_cars.php
        elseif($type == 'RequestCarsOfPerson') {
            $query = $sql->Select('c.id as "id_carro",
                                   c.placa,
                                   mo.nome as "modelo",
                                   ma.nome as "marca"');
            $query = $sql->From($query, 'carro c');
            $query = $sql->LeftOuterJoin($query, 'modelo mo', 'mo.id = c.modelo_id');
            $query = $sql->LeftOuterJoin($query, 'marca ma', 'ma.id = c.marca_id');
            $query = $sql->Where($query, 'c.pessoas_id = ' . $var);
            $result = $sql->ExecuteSQL($query, 'getArrayList');
            return $result;
        }
        //vacancies/vacancies_service.php
        elseif($type == 'RequestSomeDataReserve') {
            $query = $sql->Select('r.vaga, 
                                   r.hora_reserva, 
                                   r.hora_fim, 
                                   r.status,
                                   e.nome,
                                   e.vagas as "' . 'max_vagas'. '"');
            $query = $sql->From($query, 'reservas r');
            $query = $sql->LeftOuterJoin($query, 'estacionamentos e', 
                                                 'e.id = r.id_estac');
            $query = $sql->Where($query, 'r.data = "' . $var['data'] . '"');
            //echo $query;
            $result = $sql->ExecuteSQL($query, 'getArrayList');
            return $result; 
        }
        
        //php/operation/getParks.php
        elseif($type == 'RequestParks') {
            $query = $sql->Select('e.id,
                                   e.nome as "estacionamento",
                                   p.nome as "responsavel",
                                   e.h_func_init,
                                   e.h_func_fim,
                                   e.vagas,
                                   e.endereco,
                                   e.num,
                                   e.bairro');
            $query = $sql->From($query, 'estacionamentos e');
            $query = $sql->leftOuterJoin($query, 'pessoas p', 'p.id_estac = e.id');
            $result = $sql->ExecuteSQL($query, 'getArrayList');
            //echo $query;
            return $result;
        }
        
        //php/vacancies/vacancies_services.php
        elseif($type == 'RequestHourFuncPark') {
            $query = $sql->Select('e.h_func_init, e.h_func_fim');
            $query = $sql->From($query, 'estacionamentos e');
            $query = $sql->Where($query, 'id = ' . $var);
            $result = $sql->ExecuteSQL($query, 'getArrayList');
            return $result;
        }
        
        //NOT USED
        elseif($type == 'RequestVacanciesPark') {
            $query = $sql->Select('e.vagas');
            $query = $sql->From($query, 'estacionamentos e');
            $query = $sql->Where($query, 'id = ' . $var);
            $result = $sql->ExecuteSQL($query, 'getArray');
            return $result;
        }
        
        //operaton/vacancies_services.php
        elseif($type == 'RequestMaxVacancies'){
            $query = $sql->Select('e.vagas');
            $query = $sql->From($query, 'estacionamentos e');
            $query = $sql->Where($query, 'e.id = ' . $var);
            $result = $sql->ExecuteSQL($query, 'getArray');
            return $result;
        }

        elseif($type == 'RequestCheckIn'){
            $query = $sql->Select('r.id as "id_reserva",
                                   r.data,
                                   p.nome as "responsavel",
                                   m.nome as "mod_carro",
                                   c.placa,
                                   r.vaga,
                                   r.hora_reserva,
                                   r.hora_fim');
            $query = $sql->From($query, 'reservas r');
            $query = $sql->leftOuterJoin($query, 'carro c', 'c.id = r.id_carro');
            $query = $sql->leftOuterJoin($query, 'modelo m', 'c.modelo_id = m.id');
            $query = $sql->leftOuterJoin($query, 'pessoas p', 'r.id_pessoa = p.id');
            $query = $sql->Where($query, 'r.id_estac = ' . $var . '
                                          AND
                                          r.status = "R"');
            $result = $sql->ExecuteSQL($query, 'getArrayList');
            return $result;
        }

        elseif($type == 'RequestCheckOut'){
            $query = $sql->Select('r.id as "id_reserva",
                                   r.data,
                                   p.nome as "responsavel",
                                   m.nome as "mod_carro",
                                   c.placa,
                                   r.vaga,
                                   r.hora_reserva,
                                   r.hora_fim');
            $query = $sql->From($query, 'reservas r');
            $query = $sql->leftOuterJoin($query, 'carro c', 'c.id = r.id_carro');
            $query = $sql->leftOuterJoin($query, 'modelo m', 'c.modelo_id = m.id');
            $query = $sql->leftOuterJoin($query, 'pessoas p', 'r.id_pessoa = p.id');
            $query = $sql->Where($query, 'r.id_estac = ' . $var . '
                                          AND
                                          r.status = "U"');
            $result = $sql->ExecuteSQL($query, 'getArrayList');
            return $result;
        }
        
        else
            echo 'Opcao de Controle de SQL inválida para o Request. Contacte o suporte!';
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

        elseif($type == 'CheckPass'){
            $query = $sql->SelectCount('*');
            $query = $sql->From($query, 'pessoas p');
            $query = $sql->Where($query, 'p.senha = "' . md5($toCheck["pass"]) . '" AND ' .
                                         'p.usuario = "' . $toCheck['user'] . '"');
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
        elseif($type == 'CheckIDMark'){
            $query = $sql->BuildSelectCountFromWhere('marca', 'id', $toCheck);
            $result = $sql->ExecuteSQL($query, 'checkValue');
            return $result;
        }

        //operation/cad_cars.php
        elseif($type == 'CheckIDModel'){
            $query = $sql->BuildSelectCountFromWhere('modelo', 'id', $toCheck);
            $result = $sql->ExecuteSQL($query, 'checkValue');
            return $result;
        }

        //operation/cad_cars.php
        elseif($type == 'CheckBoard'){
            $query = $sql->SelectCount('*');
            $query = $sql->From($query, 'carro c');
            $query = $sql->Where($query, 'c.placa = "' . $toCheck . '"');
            $result = $sql->ExecuteSQL($query, 'checkValue');
            return $result;
        }

        //login/login_service & account_manager/manager_service
        elseif($type == 'CheckInactive'){
            $query = $sql->BuildSelectCountFromWhere('inactive_pessoas', 'user', $toCheck);
            $result = $sql->ExecuteSQL($query, 'checkValue');
            return $result;
        }
        
        //vacancies/vacancies_services.php
        elseif($type == 'CheckIdCar'){
            $query = $sql->BuildSelectCountFromWhere('carro', 'id', $toCheck);
            $result = $sql->ExecuteSQL($query, 'checkValue');
            return $result;
        }
        ///NOT USED
        elseif($type == 'CheckHoursPark'){
            $query = $sql->Select('e.h_func_init, e.h_func_end');
            $query = $sql->From('estacionamentos e');
            $query = $sql->Where('e.id = ' . $toCheck);
            $result = $svc->ExecuteSQL($query, 'getArrayList');
            return $query;//$result;
        }
        //NOT USED
        elseif($type == 'CheckMaxHourToPark'){
            $query = $sql->Select('e.qtd_func_vagas');
            $query = $sql->From('estacionamentos e');
            $query = $sql->Where('e.id = ' . $toCheck);
            $result = $svc->ExecuteSQL($query, 'getArray');
            return $query;//$result;
        }
        
        elseif($type == 'CheckMinHourToPark'){
            
            echo "DESENVOLVER";
        }

        else
            echo 'Opcao de Controle de SQL inválida para o Validate. Contacte o suporte!';
            
    }

    //
    //INSERTS
    //

    public static function Insert($type, $obj){
        
        $sql = new SQLService;
        
        if($type == 'insertPark'){
            
            $values = '"' . $obj['nome'] . '", ' . 
                      $obj['idResp'] . ', ' .
                      $obj['vagas'] . ', ' . 
                      '"' . $obj['h_init'] . '", ' . 
                      '"' . $obj['h_end'] . '", ' . 
                      '"' . $obj['end'] . '", ' . 
                      '"' . $obj['num'] . '", ' . 
                      '"' . $obj['bairro'] . '"';
            $query = $sql->Insert('estacionamentos',
                                  'nome, 
                                   id_pessoa, 
                                   vagas, 
                                   h_func_init, 
                                   h_func_fim, 
                                   endereco,
                                   num,
                                   bairro',
                                  $values);
            $result = $sql->ExecuteSQL($query, 'OnlyExecute');
            return $result;
        }

        //operation/cad_cars.php
        elseif($type == 'insertCar'){

            $query = $sql->Insert('carro', 
                                  'placa, 
                                   marca_id,
                                   pessoas_id,
                                   modelo_id',
                                   '"' . $obj['placa'] . '", ' .
                                   $obj['idMarca'] . ', ' .
                                   $obj['idUser'] . ', ' .
                                   '"' . $obj['idModelo'] . '"');
            
            $result = $sql->ExecuteSQL($query, 'OnlyExecute');
            return $result;

        }

        //account_mananger/register_person
        elseif($type == 'registerPerson'){
            $query = $sql->BuildSqlInsertUsers($obj['name'], $obj['user'], $obj['pass'], 
                                                       $obj['email'], $obj['cpf'], $obj['address'],  
                                                       $obj['number'], $obj['comp'], $obj['block'], 
                                                       $obj['cep'], $obj['city'], $obj['state'], 
                                                       $obj['tel'], $obj['cel'], $obj['access'], $obj['id_estac']);
            $result = $sql->ExecuteSQL($query, 'OnlyExecute');
            return $result;
        }
        
        //admin/admin_service
        elseif($type == 'InactivePerson'){
            $query = $sql->BuildSqlInactivePerson($obj['user'], $obj['cause']);
            $result = $sql->ExecuteSQL($query, 'OnlyExecute');
            return $result;
        }
        
        //vacancies/vacancies_services.php
        elseif($type == 'RegisterVacancy'){
            
            $query = $sql->Insert('reservas', 
                                  'id_carro, 
                                   id_estac,
                                   id_pessoa,
                                   vaga, 
                                   hora_reserva, 
                                   hora_fim, 
                                   data, 
                                   status',
                                   $obj['id_carro'] . ', ' .
                                   $obj['id_estac'] . ', ' .
                                   $obj['id_pessoa'] . ', ' .
                                   $obj['vaga'] . ', ' .
                                   '"' . $obj['hora_reserva'] . '", ' . 
                                   '"' . $obj['hora_fim'] . '", ' . 
                                   '"' . $obj['data'] . '", ' . 
                                   '"' . $obj['status'] . '"');
            
            $result = $sql->ExecuteSQL($query, 'OnlyExecute');
            return $result;
        }

        
        else
            echo 'Opcao de Controle de SQL inválida para o Insert. Contacte o suporte!';


    }

    //
    //UPDATES
    //


    public static function Update($type, $obj){
        
        $sql = new SQLService;
        
        //admin/admin_service
        if($type =='UpdateUser'){
            $query = $sql->BuildSqlUpdateSingleValue('pessoas', $obj['column'], $obj['value'], 'usuario', $obj['user']);
            $result = $sql->ExecuteSQL($query, 'OnlyExecute');
            return $result;
        }
        
        elseif($type == 'UpdatePark'){
            $values = 'e.nome = "' . $obj['nome'] . '", ' . 
                      'e.vagas = ' . $obj['vagas'] . ', ' .
                      'e.responsavel = ' . $obj['responsavel'] . ', ' .
                      'e.h_func_init = "' . $obj['h_func_init'] . '", ' . 
                      'e.h_func_fim = "' . $obj['h_func_fim'] . '"';
            
            $query = $sql->Update('estacionamentos e', $values);
            $query = $sql->Where($query, 'e.id = ' . $obj['id']);
            $result = $sql->ExecuteSQL($query, 'OnlyExecute');
            return $result;
        }

        elseif($type == 'setCheckIn'){
            $values = 'r.status = "U"';
            
            $query = $sql->Update('reservas r', $values);
            $query = $sql->Where($query, 'r.id = ' . $obj);
            $result = $sql->ExecuteSQL($query, 'OnlyExecute');
            return $result;
        }

        elseif($type == 'setCheckOut'){
            $values = 'r.status = "L"';
            
            $query = $sql->Update('reservas r', $values);
            $query = $sql->Where($query, 'r.id = ' . $obj);
            $result = $sql->ExecuteSQL($query, 'OnlyExecute');
            return $result;
        }
            
        else
            echo 'Opcao de Controle de SQL inválida para o Update. Contacte o suporte!';
    }

    public static function Delet(){
    }

    //
    //REPORTS
    //

    public static function Report($type, $obj){
        
        $sql = new SQLService;
    
        //operation/relat_boardXcar.php
        if($type == 'BoardXCar'){
            $query = $sql->Select('p.nome,
                                   p.celular,
                                   ma.nome as "marca",
                                   mo.nome as "modelo"');
            $query = $sql->From($query, 'pessoas p');
            $query = $sql->LeftOuterJoin($query, 'carro c', 'c.pessoas_id = p.id');  
            $query = $sql->LeftOuterJoin($query, 'marca ma', 'ma.id = c.marca_id');  
            $query = $sql->LeftOuterJoin($query, 'modelo mo', 'mo.id = c.modelo_id');
            $query = $sql->Where($query, 'c.placa = "' . $obj . '"');  
            $result = $sql->ExecuteSQL($query, 'getArrayList');
            return $result;
        }            
        
        //operation/relat_inf_user.php
        elseif($type == 'InfUser'){
            $query = $sql->Select('p.nome,
                                   p.celular,
                                   p.cpf,
                                   c.placa,
                                   ma.nome as "marca",
                                   mo.nome as "modelo"');
            $query = $sql->From($query, 'pessoas p');
            $query = $sql->LeftOuterJoin($query, 'carro c', 'c.pessoas_id = p.id');  
            $query = $sql->LeftOuterJoin($query, 'marca ma', 'ma.id = c.marca_id');  
            $query = $sql->LeftOuterJoin($query, 'modelo mo', 'mo.id = c.modelo_id');
            $query = $sql->Where($query, 'p.usuario = "' . $obj . '"');  
            //echo $query;
            $result = $sql->ExecuteSQL($query, 'getArrayList');
            return $result;
        }
            
        else
            echo 'Opcao de Controle de SQL inválida para o Report. Contacte o suporte!';

        return NULL;

    }
}

?>
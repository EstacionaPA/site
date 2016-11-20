<?php

class RegisterPark extends ManagerAbstract{
    
    public function controll($park) {
        
        $svc = new MasterService;

        if(!isset($park['nome']) or !isset($park['user']) or 
            !isset($park['h_init']) or !isset($park['h_end']) or !isset($park['end']) or 
            !isset($park['num']) or !isset($park['bairro'])){
                echo 'nullFields';
                return;
        }
        if($park['nome'] == '' or $park['idresp'] == '' or 
            $park['h_init'] == '' or $park['h_end'] == '' or $park['end'] == '' or 
            $park['num'] == '' or $park['bairro'] == ''){
                echo 'nullFields';
                return;
        }

        if(SqlController::Validate('CheckUser', $park['responsavel']) == 'done'){
            $park['idResp'] = SqlController::Request('RequestIdUser', $park['responsavel']);
            $insert = SqlController::Insert('insertPark', $park);
            
            if($insert) echo 'success';
                else $insert;
        }
        else
            echo '!user';
    }
    
}


?>
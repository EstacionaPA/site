<?php

class RegisterPark extends ManagerAbstract{
    
    public function controll($park) {
        
        $svc = new MasterService;
        
        if((isset($park['responsavel']) and $park['responsavel'] <> '') and
           (isset($park['nome']) and $park['nome'] <> '') and
           (isset($park['vagas']) and $park['vagas'] <> '')){
            if(SqlController::Validate('CheckUser', $park['responsavel']) == 'done'){
                $park['responsavel'] = SqlController::Request('RequestIdUser', $park['responsavel']);
                $insert = SqlController::Insert('insertPark', $park);
                if($insert) echo 'success';
                else $insert;
            }
            else
                echo '!user';
        }else
            echo 'nullFields';
    }
    
}


?>
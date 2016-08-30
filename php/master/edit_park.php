<?php

class EditPark extends ManagerAbstract {
    
    public function controll($park) {
        
        $svc = new MasterService;
        if((isset($park['responsavel']) and $park['responsavel'] <> '') and
           (isset($park['nome']) and $park['nome'] <> '') and
           (isset($park['vagas']) and $park['vagas'] <> '') and
           (isset($park['id']) and $park['id'] <> '')){
            if(SqlController::Validate('CheckUser', $park['responsavel']) == 'done'){
                $park['responsavel'] = SqlController::Request('RequestIdUser', $park['responsavel']);
                $update = SqlController::Update('UpdatePark', $park);
                if($update) echo 'success';
                else $update;
            }
            else
                echo '!user';
        }else
            echo 'nullFields';
    }
}

?>
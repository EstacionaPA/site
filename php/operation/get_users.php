<?php

class GetUsers extends ManagerAbstract{
    public function controll($valid){
        if($valid == 'admin'){
            $user = json_decode(BackEndService::getDataLogin(), true);
            $users = SqlController::Request('RequestUsersAdmin', $user[0]['idEstac']);
        }else 
            $users = SqlController::Request('RequestUsers', NULL);
        
            
        echo json_encode($users);

    }
}

?>
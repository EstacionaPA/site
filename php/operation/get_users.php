<?php

class GetUsers extends ManagerAbstract{
    public function controll(){
        
        $users = SqlController::Request('RequestUsers', NULL);
        echo json_encode($users);

    }
}

?>
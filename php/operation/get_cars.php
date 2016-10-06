<?php

class GetCars extends ManagerAbstract{
    public function controll($form){
        
        $idUser = SqlController::Request('RequestIdUser', $form['user']);
        echo json_encode(SqlController::Request('RequestCarsOfPerson', $idUser));

    }
}

?>
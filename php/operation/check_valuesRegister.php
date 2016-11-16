<?php

class CheckValuesRegister extends ManagerAbstract{

    public function controll($form){

        $feedback = array('CPF' => 'null',
                          'email' => 'null',
                          'user' => 'null');
       
        if(isset($form['cpf']))
            $feedback['CPF'] = SqlController::Validate('CheckCPF', $form['cpf']);

        if(isset($form['email']))
            $feedback['email'] = SqlController::Validate('CheckEmail', $form['email']);
        
        if(isset($form['user']))
            $feedback['user'] = SqlController::Validate('CheckUser', $form['user']);

        echo json_encode($feedback);                  

    }

}

?>
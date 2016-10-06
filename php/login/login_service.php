<?php

class ServiceLogin {
    public function validForm($form){
        
        if((!isset($form['user']) or !isset($form['pass']))){
            echo 'inexistente';
            return 'nullFields';
        }
        
        if($form['user'] == '' or $form['pass'] == ''){
            echo 'vazio';
            return 'nullFields';
        }
    }
    
    public function insertSlashes($var){
        return addslashes($var);
    }
    
    public function validLogin($form){

        
        $validUser = SqlController::validate('CheckUser', $form['user']);
        
        $validPass = SqlController::validate('CheckPass', $form);
        
        if($validPass == 'done' and $validUser == 'done')
            return 'done';
        
        else
            return '!user!pass';
            
        
    }
    
    public function checkInactive($user){
        
        $check = SqlController::Validate('CheckInactive', $user);
        return $check;
    }

}

?>
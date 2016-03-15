<?php

class ServiceLogin {
    public function validVars($user, $pass){
        
        if((!isset($user) and !isset($pass)) or 
            ($user != '' and $pass != '')) 
            
                return NULL;
        else
            echo 'nullFields';
            
    }
    
    public function insertSlashes($var){
        return addslashes($var);
    }
    
    public function validLogin($user, $pass){

        
        $validUser = SqlController::validate('CheckUser', $user);
        
        $validPass = SqlController::validate('CheckPass', $pass);
        
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
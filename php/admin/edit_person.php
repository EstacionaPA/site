<?php

class EditPersonController extends ManagerAbstract {
    
    public function controll($person){
                    //required on to_action.php
        $svc = new AdminService;
        
        $checkUser = $svc->checkSingleValue('CheckUser', $person['usuario']);
        $checkInactive = $svc->checkInactive($person['usuario']);
        $validOperation = false;

        //Validation if user is not inactived
        if($checkInactive == 'done'){
            echo 'inactive';
            return;
        }

        //Validation for user field content
        if($checkUser == 'done'){
            
            //Validation if email already exist and the field content
            if($person['email'] != ''){
                $checkEmail = $svc->checkSingleValue('CheckEmail', $person['email']);
                if($checkEmail == 'done'){
                    echo 'email';
                    return;
                }
            };
            
            //Check all the JSON values

            //while($value = current($person)){
            for($i = 0; $i < count($person); $i = $i + 1){
                $value = current($person);
                //This conditional ignore JSON null values, null access value and user field
                if($value != 'n' and $value != '----NULO----' and key($person) != 'usuario'){
                    $update = $svc->update(key($person), $value, $person['usuario']);
                    $validOperation = true;
                }
                
                //array_shift($person);
                next($person);
            }
            
            if($validOperation == true) 
                echo 'success';
            else
                echo 'nullFields';
                
            return;
            
        }
        else
            echo '!user';
        
        
    }
    
}

?>
<?php

class InactivePerson extends ManagerAbstract {
    
    public function controll($person){
                    //required on to_action.php
        $svc = new AdminService;
        
        $checkUser = $svc->checkSingleValue('CheckUser', $person['user']);
    
        if($checkUser == 'done'){
            if($person['cause'] != ''){
                $result = $svc->inactive($person['user'], $person['cause']);
                 
                if($result)
                    echo 'done';
            }
            else
                echo 'nullCause';
        }
        else
            echo '!user';
    }
}

?>
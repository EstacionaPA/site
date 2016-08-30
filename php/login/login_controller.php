<?php

require 'php/login/login_service.php';

Class Login extends ManagerAbstract{
    
    public function controll($form) {
        
        $svcLogin = new ServiceLogin;
        
        $valid = $svcLogin->validForm($form);

        if($valid == 'nullFields') return $valid;
        
        $u = $svcLogin->insertSlashes($form['user']);
        $p = $svcLogin->insertSlashes($form['pass']);


        $validLogin = $svcLogin->validLogin($u, $p);
        
        
        $checkInactive = $svcLogin->checkInactive($u);
       
        if($validLogin == 'done') {
            if($checkInactive == 'dont'){
                $_SESSION['login'] = $u;
                echo 'done';
            }
            else{
                echo 'inactive';
            }
                
        }
        
        else
            echo $validLogin;
    
    }
}

?>
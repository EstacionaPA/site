<?php

require 'php/login/login_service.php';

Class Login extends ManagerAbstract{
    
    public function controll($form) {
        
        $svcLogin = new ServiceLogin;
        
        $valid = $svcLogin->validForm($form);

        if($valid == 'nullFields') return $valid;
        
        $form['user'] = $svcLogin->insertSlashes($form['user']);
        $form['pass'] = $svcLogin->insertSlashes($form['pass']);


        $validLogin = $svcLogin->validLogin($form);
        
        
        $checkInactive = $svcLogin->checkInactive($form['user']);
       
        if($validLogin == 'done') {
            if($checkInactive == 'dont'){
                $_SESSION['login'] = $form['user'];
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
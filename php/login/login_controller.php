<?php

require 'login_service.php';

Class Login{
    
    public function __construct($form) {
        session_start();
        $this->controll($form);
    }
    
    public function controll($form) {
        
        $svcLogin = new ServiceLogin;
        
        $valid = $svcLogin->validPOST($form['user'], $form['pass']);

        if($valid) {
            echo $valid;
            return;
        }
        
        $u = $svcLogin->insertSlashes($form['user']);
        $p = $svcLogin->insertSlashes($form['pass']);

        $validLogin = $svcLogin->validLogin($u, $p);
        $checkInactive = $svcLogin->checkInactive($u);

        if($validLogin == 'done') {
            if($checkInactive == 'dont'){
                $_SESSION['login'] = $u;
                echo $validLogin;
            }
            else{
                echo 'inactive';
                return;
            }
                
        }
        
        else
            echo $validLogin;
    }
}

?>
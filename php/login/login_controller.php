<?php

require 'login_service.php';

Class Login{
    
    public function __construct() {
        session_start();
        $this->controll();
    }
    
    public function controll() {
        
        $svcLogin = new ServiceLogin;
        
        $valid = $svcLogin->validPOST($_POST['user'], $_POST['pass']);

        if($valid) {
            $svcLogin->ech($valid);
            return;
        }
        
        $u = $svcLogin->insertSlashes($_POST['user']);
        $p = $svcLogin->insertSlashes($_POST['pass']);

        $validLogin = $svcLogin->validLogin($u, $p);
        
        if($validLogin == 'success') {
            
            $_SESSION['login'] = $u;
            $svcLogin->ech($validLogin);
        }
        
        else
            $svcLogin->ech($validLogin);
    }
}
$login = new Login;

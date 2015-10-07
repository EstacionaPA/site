<?php

require 'service_login.php';
require 'access_class.php';

Class Login{
    
    public function init() {
        session_start();
        $this->controll();
    }
    
    public function controll() {
        
        $svcLogin = new ServiceLogin;
        $svcAccess = new ServiceAccess;
        
        $valid = $svcLogin->validPOST($_POST['user'], $_POST['pass']);

        
        if($validContent) {
            $svcLogin->ech($valid);
            return;
        }
        $u = $svcLogin->insertSlashes($_POST['user']);
        $p = $svcLogin->insertSlashes($_POST['pass']);

        $validLogin = $svcLogin->validLogin($u, $p);
        
        if($validLogin == 'success' and !isset($validContent)) {
            
            $_SESSION['login'] = $u;
            $svcLogin->ech($validLogin);
        }
        
        else
            $svcLogin->ech($validLogin);
    }
}
$login = new Login;
$login->init();

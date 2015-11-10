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
            echo $valid;
            return;
        }
        
        $u = $svcLogin->insertSlashes($_POST['user']);
        $p = $svcLogin->insertSlashes($_POST['pass']);

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
$login = new Login;

?>
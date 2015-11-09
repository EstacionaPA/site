<?php

require '../SQL/sql_controller.php';

class PageController {
    
     public function __construct() {
        session_start();
        $this->Controll();
     } 
     
     public function Controll() {
        
        if(isset($_SESSION['login'])){
            
            $user = $_SESSION['login'];
            
            $access = SqlController::Request('RequestAccess', $user);
            
            switch($access){
                case 'a': 
                    header('location: ../../html/pages/main_login_a.html');
                    break;
                
                case 'f':
                    header('location: ../../html/pages/main_login_f.html');
                    break;
                    
                case 'c':
                    header('location: ../../html/pages/main_login_c.html');
                    break;
                    
                default:
                    header('location: ../../html/forms/form_login.html');
                    break;
            }
        }
        else
            header('location: ../../html/forms/form_login.html');
     
     }
}

$page = new PageController;
    
?>
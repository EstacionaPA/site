<?php

require 'php/login/login_controller.php';
require 'php/operation/relat_inf_user.php';
require 'php/SQL/sql_controller.php';
require 'php/operation/relat_boardXcar.php';

class PageController {
    
     public function __construct() {
        session_start();
     } 
     
     public function validLogin($form){
         $loginController = new Login($form);
     }
     
     public function getAccess(){
           if(isset($_SESSION['login'])){
                $user = $_SESSION['login'];
                $access = SqlController::Request('RequestAccess', $user);
                return $access;
           }
           else
                return '!login';
     }
     
     public function openPageByAccess() {
        
        if(isset($_SESSION['login'])){
            
            $user = $_SESSION['login'];
            $access = SqlController::Request('RequestAccess', $user);
            
            if($access == 'a')
                return $this->getPage('html/pages/main_login_a.html');
                
            else if($access == 'f')
                return $this->getPage('html/pages/main_login_f.html');
                    
            else if($access == 'c')
                return $this->getPage('html/pages/main_login_c.html');      
        }
        else 
            return $this->getPage('html/forms/form_login.html');
     }
     
    public function getPage($path){
        $page = stream_context_create(array(
            'http' => array(
                'timeout' => 1
                )
            )
        );
    
        return file_get_contents($path, 0, $page); 
    }
    
    public function sair(){
        $_SESSION['login'] = '';
        session_destroy();
        return $this->getPage('index.html');
    }
    
    public function reportInfUser($name){
        if($this->getAccess() == 'a'){
            $report = new ReportInfUser();
            return $report->getInformations($name);
        }
        else
            return $this->openPageByAccess();
    }
    
    public function reportCarXBoard($bord){
        if($this->getAccess() == 'a'){
            $report = new ReportBoardXCard();
            return $report->getInformations($bord);
        }
        else
            return $this->openPageByAccess();
    }
}


    
?>
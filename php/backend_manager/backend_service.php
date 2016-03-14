<?php

require 'manager_controller.php';
require 'php/SQL/sql_controller.php';

class BackEndService {
    
     public function __construct() {
        session_start();
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
    
    public function validLogin($form){
        $manager = new ManagerController;
        echo $manager->manager('checkLogin', $form);
     }
    
    public function reportInfUser($name){
        $manager = new ManagerController;
        echo $manager->manager('relatInfUser' , $name);
    }
    
    public function reportCarXBoard($board){
        $manager = new ManagerController;
        echo $manager->manager('relatBoardXCar', $board);
    }
    
    public function editUser($form){
        $manager = new ManagerController;
        echo $manager->manager('editUser', $form);
    }
    
    public function inactiveUser($form){
        $manager = new ManagerController;
        echo $manager->manager('inactiveUser', $form);
    }
    
    public function registerUser($form){
        $manager = new ManagerController;
        echo $manager->manager('registerUser', $form);
    }
    public function registerClient($form){
        $manager = new ManagerController;
        echo $manager->manager('registerClient', $form);
    }
    public function registerCar($form){
        $manager = new ManagerController;
        echo $manager->manager('registerCar', $form);
    }
}


    
?>
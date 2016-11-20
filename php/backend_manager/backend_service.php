<?php

require 'manager_controller.php';

require 'php/SQL/sql_controller.php';

class BackEndService {
    
     public function __construct() {
        session_start();
     } 
     
     public function getAccess($data){
           if(isset($_SESSION['login']) or 
               (strpos($data, 'Android') != '')){
                    if(strpos($data, 'Android') == '') {
                    
                        $data = $_SESSION['login'];
                        $access = SqlController::Request('RequestAccess', $data);
                    }
                    else
                        $access = 'valid';
                    
                    
                    return $access;
           }
           else
                return '!login';

    
     }

     public function getAccessMobile($data){
           
           $user = SqlController::Validate('CheckUser', $data['user']);
           $pass = SqlController::Validate('CheckPass', $data);

           if($user == 'done' and $pass == 'done')
                echo $access = SqlController::Request('RequestAccess', $data['user']);
     }
     
     public function openPageByAccess() {
        if(isset($_SESSION['login'])){
            
            $user = $_SESSION['login'];
            $access = SqlController::Request('RequestAccess', $user);
            
            if($access == 'm')
                return $this->buildPage('login_m');

            else if($access == 'a')
                return $this->buildPage('login_a');
                
            else if($access == 'f')
                return $this->buildPage('login_f');
                    
            else if($access == 'c')
                return $this->buildPage('login_c');
            
            else
                echo 'Acesso invalido. Contacte o suporte!';
                return $this->buildPage('index');
                
        }
        else 
            return $this->buildPage('login');
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
    
    public function buildPage($type){

        if($type == 'index'){
            $page = file_get_contents('front-web/html/head/main.html') . 
                    file_get_contents('front-web/html/head/index.html') . 
                            file_get_contents('front-web/html/body/menu.html') . 
                            file_get_contents('front-web/html/body/slideshow.html') . 
                    file_get_contents('front-web/html/foot/main.html');   
        }
        
        elseif($type == 'about'){
            $page = file_get_contents('front-web/html/head/main.html') . 
                    file_get_contents('front-web/html/head/end.html') . 
                            file_get_contents('front-web/html/body/menu.html') . 
                            file_get_contents('front-web/html/body/about.html') . 
                    file_get_contents('front-web/html/foot/main.html'); 
                    
        }

        elseif($type == 'login'){
            $page = file_get_contents('front-web/html/head/main.html') . 
                    file_get_contents('front-web/html/head/end.html') . 
                        file_get_contents('front-web/html/body/menu.html') .
                        file_get_contents('front-web/html/body/form_login.html') . 
                    file_get_contents('front-web/html/foot/main.html') .
                    file_get_contents('front-web/html/foot/login.html');
        }

        elseif($type == 'register'){
            $page = file_get_contents('front-web/html/head/main.html') . 
                    file_get_contents('front-web/html/head/end.html') . 
                        file_get_contents('front-web/html/body/menu.html') .
                        file_get_contents('front-web/html/body/register/accept.html') .
                        file_get_contents('front-web/html/body/register/data_system.html') .
                        file_get_contents('front-web/html/body/register/data_person.html') .
                        file_get_contents('front-web/html/body/register/data_geo.html') .
                    file_get_contents('front-web/html/foot/main.html') . 
                    file_get_contents('front-web/html/foot/register.html');
        }

        elseif($type == 'login_m'){
            $page = file_get_contents('front-web/html/head/main.html') . 
                    file_get_contents('front-web/html/head/submenu.html') . 
                        file_get_contents('front-web/html/body/master/m_menu.html') .
                        file_get_contents('front-web/html/body/master/m_main.html') .
                    file_get_contents('front-web/html/foot/main.html');
        }

        elseif($type == 'login_a'){
            $page = file_get_contents('front-web/html/head/main.html') . 
                    file_get_contents('front-web/html/head/submenu.html') . 
                        file_get_contents('front-web/html/body/admin/a_menu.html') .
                        file_get_contents('front-web/html/body/admin/a_main.html') .
                    file_get_contents('front-web/html/foot/main.html');
        }

        elseif($type == 'login_f'){
            $page = file_get_contents('front-web/html/head/main.html') . 
                    file_get_contents('front-web/html/head/submenu.html') . 
                        file_get_contents('front-web/html/body/func/f_menu.html') .
                        file_get_contents('front-web/html/body/func/f_main.html') .
                    file_get_contents('front-web/html/foot/main.html');
        }

        elseif($type == 'login_c'){
            $page = file_get_contents('front-web/html/head/main.html') . 
                    file_get_contents('front-web/html/head/submenu.html') . 
                        file_get_contents('front-web/html/body/client/c_menu.html') .
                        file_get_contents('front-web/html/body/client/c_main.html') .
                    file_get_contents('front-web/html/foot/main.html');
        }

        elseif($type == 'cadPerson_m'){
            $page = file_get_contents('front-web/html/head/main.html') . 
                    file_get_contents('front-web/html/head/submenu.html') . 
                        file_get_contents('front-web/html/body/master/m_menu.html') .
                        file_get_contents('front-web/html/body/master/register_person.html') .
                        file_get_contents('front-web/html/body/register/data_person.html') .
                        file_get_contents('front-web/html/body/register/data_geo.html') .
                    file_get_contents('front-web/html/foot/main.html') .
                    file_get_contents('front-web/html/foot/register.html') .
                    file_get_contents('front-web/html/foot/cadPersonMaster.html');
        }

        return $page;
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
    public function vacanciesRequest($form){
        $manager = new ManagerController;
        echo $manager->manager('vacanciesRequest', $form);
    }
    public function registerPark($form){
        $manager = new ManagerController;
        echo $manager->manager('registerPark', $form);
    }
    public function editPark($form){
        $manager = new ManagerController;
        echo $manager->manager('editPark', $form);
    }
    public function vacanciesConsult($form){
        $manager = new ManagerController;
        echo $manager->manager('vacanciesConsult', $form);
    }

    public function getParks($form){
        $manager = new ManagerController;
        echo $manager->manager('getParks', $form);
    }

    public function getCars($form){
        $manager = new ManagerController;
        echo $manager->manager('getCars', $form);
    }

    public function getMarks($form){
        $manager = new ManagerController;
        echo $manager->manager('getMarks', $form);
    }

    public function getModels($form){
        $manager = new ManagerController;
        echo $manager->manager('getModels', $form);
    }

    public function checkValuesRegister($form){
        $manager = new ManagerController;
        echo $manager->manager('checkValuesRegister', $form);
    }
}


    
?>
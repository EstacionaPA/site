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
                return $this->buildPage('m_login');

            else if($access == 'a')
                return $this->buildPage('a_login');
                
            else if($access == 'f')
                return $this->buildPage('f_login');
                    
            else if($access == 'c')
                return $this->buildPage('c_login');
            
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

        elseif($type == 'vacanciesConsult'){
            $page = file_get_contents('front-web/html/head/main.html') . 
                    file_get_contents('front-web/html/head/end.html') . 
                            file_get_contents('front-web/html/body/menu.html') . 
                            file_get_contents('front-web/html/body/services/vacancies_consult.html') . 
                    file_get_contents('front-web/html/foot/main.html') .
                    file_get_contents('front-web/html/foot/services.html'); 
        }

        elseif($type == 'parksConsult'){
            $page = file_get_contents('front-web/html/head/main.html') . 
                    file_get_contents('front-web/html/head/end.html') . 
                            file_get_contents('front-web/html/body/menu.html') . 
                            file_get_contents('front-web/html/body/services/parks_consult.html') . 
                    file_get_contents('front-web/html/foot/main.html') .
                    file_get_contents('front-web/html/foot/services.html'); 
                    
        }

        elseif($type == 'm_login'){
            $page = file_get_contents('front-web/html/head/main.html') . 
                    file_get_contents('front-web/html/head/end.html') . 
                        file_get_contents('front-web/html/body/master/m_menu.html') .
                        file_get_contents('front-web/html/body/master/m_main.html') .
                    file_get_contents('front-web/html/foot/main.html');
        }

        elseif($type == 'm_cadPerson'){
            $page = file_get_contents('front-web/html/head/main.html') . 
                    file_get_contents('front-web/html/head/end.html') . 
                        file_get_contents('front-web/html/body/master/m_menu.html') .
                        file_get_contents('front-web/html/body/master/register_person.html') .
                        file_get_contents('front-web/html/body/register/data_person.html') .
                        file_get_contents('front-web/html/body/register/data_geo.html') .
                    file_get_contents('front-web/html/foot/main.html') .
                    file_get_contents('front-web/html/foot/register.html') .
                    file_get_contents('front-web/html/foot/cadPersonMaster.html');
        }

        elseif($type == 'm_cadCars'){
            $page = file_get_contents('front-web/html/head/main.html') . 
                    file_get_contents('front-web/html/head/end.html') . 
                        file_get_contents('front-web/html/body/master/m_menu.html') .
                        file_get_contents('front-web/html/body/register/cadCars.html') .
                    file_get_contents('front-web/html/foot/main.html') .
                    file_get_contents('front-web/html/foot/cadCars.html');
        }

        elseif($type == 'm_cadParks'){
            $page = file_get_contents('front-web/html/head/main.html') . 
                    file_get_contents('front-web/html/head/end.html') . 
                        file_get_contents('front-web/html/body/master/m_menu.html') .
                        file_get_contents('front-web/html/body/master/cadParks.html') .
                    file_get_contents('front-web/html/foot/main.html') .
                    file_get_contents('front-web/html/foot/cadParks.html');
        }

        elseif($type == 'a_login'){
            $page = file_get_contents('front-web/html/head/main.html') . 
                    file_get_contents('front-web/html/head/end.html') . 
                        file_get_contents('front-web/html/body/admin/a_menu.html') .
                        file_get_contents('front-web/html/body/admin/a_main.html') .
                    file_get_contents('front-web/html/foot/main.html');
        }

        elseif($type == 'f_login'){
            $page = file_get_contents('front-web/html/head/main.html') . 
                    file_get_contents('front-web/html/head/end.html') . 
                        file_get_contents('front-web/html/body/func/f_menu.html') .
                        file_get_contents('front-web/html/body/func/f_main.html') .
                    file_get_contents('front-web/html/foot/main.html');
        }

        elseif($type == 'c_login'){
            $page = file_get_contents('front-web/html/head/main.html') . 
                    file_get_contents('front-web/html/head/end.html') . 
                        file_get_contents('front-web/html/body/client/c_menu.html') .
                        file_get_contents('front-web/html/body/client/c_main.html') .
                    file_get_contents('front-web/html/foot/main.html');
        }

        elseif($type == 'c_cadCars'){
            $page = file_get_contents('front-web/html/head/main.html') . 
                    file_get_contents('front-web/html/head/end.html') . 
                        file_get_contents('front-web/html/body/client/c_menu.html') .
                        file_get_contents('front-web/html/body/register/cadCars.html') .
                    file_get_contents('front-web/html/foot/main.html') .
                    file_get_contents('front-web/html/foot/cadCars_client.html');
        }

        elseif($type == 'c_reqVacancy'){
            $page = file_get_contents('front-web/html/head/main.html') . 
                    file_get_contents('front-web/html/head/end.html') . 
                        file_get_contents('front-web/html/body/client/c_menu.html') .
                        file_get_contents('front-web/html/body/client/c_reqVacancy.html') .
                    file_get_contents('front-web/html/foot/main.html') .
                    file_get_contents('front-web/html/foot/req_vacancy.html');
        }

        else
            return 'Houve um erro na construção da página. Contacte o suporte!';
        

        return $page;
    }

    public function getDataLogin(){
        if(isset($_SESSION['login'])) {
            $data = array(array('id' => SqlController::Request('RequestIdUser', $_SESSION['login']),
                                'nome' => SqlController::Request('RequestName', $_SESSION['login']),
                                'usuario' => $_SESSION['login']));
            return json_encode($data);
        }
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

    public function getUsers($form){
        $manager = new ManagerController;
        echo $manager->manager('getUsers', $form);
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
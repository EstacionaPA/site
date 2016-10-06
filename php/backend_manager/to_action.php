<?php

include 'php/login/login_controller.php';

include 'php/operation/cad_cars.php';
include 'php/operation/relat_inf_user.php';
include 'php/operation/relat_boardXcar.php';
include 'php/operation/get_parks.php';
include 'php/operation/get_cars.php';

include 'php/admin/admin_service.php';
include 'php/admin/edit_person.php';
include 'php/admin/inactive_person.php';
include 'php/admin/register_person.php';

include 'php/master/master_service.php';
include 'php/master/register_park.php';
include 'php/master/edit_park.php';

include 'php/vacancies/vacancies_services.php';
include 'php/vacancies/vacancies_request.php';
include 'php/vacancies/vacancies_consult.php';



class ToActionClass{                    //Similar to C/C++ pointer
    public function convert($action, &$person){
            
            if($action == 'checkLogin'){
                $class = new Login;
                return $class;
            }

            elseif($action == 'registerUser') {
                $class = new registerPersonController;
                return $class;
            }
            elseif($action == 'registerCar'){
                $class = new RegisterCar;
                return $class;
            }
            elseif($action == 'registerClient') {
                $class = new registerPersonController;
                
                //Similar to C/C++ pointer
                $person['access'] = 'c';
                return $class;
            }
            elseif($action == 'editUser'){
                $class = new EditPersonController;
                return $class;
            }
            elseif($action == 'inactiveUser'){
                $class = new InactivePerson;
                return $class;
            }
            elseif($action == 'reservar'){
                $class = new DoReserve;
                return $class;
            }
            elseif($action == 'relatBoardXCar'){
                $class = new ReportBoardXCard;
                return $class;
            }
            elseif($action == 'relatInfUser'){
                $class = new ReportInfUser;
                return $class;
            }
            
            elseif($action == 'vacanciesRequest'){
                $class = new VacanciesRequest;
                return $class;
            }
            
            elseif($action == 'vacanciesConsult'){
                $class = new VacanciesConsult;
                return $class;
            }    
                
            elseif($action == 'registerPark'){
                $class = new RegisterPark;
                return $class;
            }
        
            elseif($action == 'editPark'){
                $class = new EditPark;
                return $class;
            }

            elseif($action == 'getParks'){
                $class = new GetParks;
                return $class;
            }

            elseif($action == 'getCars'){
                $class = new GetCars;
                return $class;
            }
            
            else
                echo 'Erro de conversao do comando para a classe PHP.';
               
        }
        
}

?>
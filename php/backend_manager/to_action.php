<?php

require 'php/login/login_controller.php';

require 'php/admin/admin_service.php';
require 'php/admin/edit_person.php';
require 'php/admin/inactive_person.php';
require 'php/admin/register_person.php';

require 'php/operation/cad_cars.php';
require 'php/operation/relat_inf_user.php';
require 'php/operation/relat_boardXcar.php';

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
            
            else
                return 'dont';
        }
}

?>
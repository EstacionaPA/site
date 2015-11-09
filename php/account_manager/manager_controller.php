<?php

require 'manager_service.php';
require 'to_action.php';

class ManagerController{
    public function __construct(){
        
        $svc = new ManagerService;
        $convert = new ActionToClass;
        
        $checkPostPerson = $svc->checkPost($_POST['pessoa']);
        $checkPostAction = $svc->checkPost($_POST['acao']);
        
        if($checkPostAction == 'done' and $checkPostPerson == 'done') {
            $person = $svc->getJSONPost($_POST['pessoa']);
                                                                //Used only in 'CadastroCliente' mode
            $class = $convert->convert($_POST['acao'], $person);
    
            if($class <> 'dont'){            
                //the ManagerAbtstract are required in manager_service.php
                ManagerAbstract::doAction($class, $svc, $person);
            }
            else 
                echo 'nullFields';   
        }
        else
            echo 'nullFields';  
    }
}

$init = new ManagerController;

?>
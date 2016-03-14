<?php

require 'manager_service.php';
require 'manager_abstract.php';
require 'to_action.php';

class ManagerController{
    public function manager($action, $data){
        
        $svc = new ManagerService;
        $convert = new ToActionClass;
        
        $checkAction = $svc->checkVar($action);
        $checkData = $svc->checkVar($data);
        
        if($checkAction == 'done' and $checkData == 'done') {
                                                //Used only in 'CadastroCliente' mode
            $class = $convert->convert($action, $data);
    
            if($class <> 'dont'){            
                ManagerAbstract::doAction($class, $data);
            }
            else 
                echo 'nullFields';   
        }
        else
            echo 'nullFields';  
    }
}

?>
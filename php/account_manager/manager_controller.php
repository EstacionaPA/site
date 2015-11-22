<?php

require 'php/account_manager/manager_service.php';
require 'php/account_manager/manager_abstract.php';
require 'php/account_manager/to_action.php';

class ManagerController{
    public function manager($action, $data){
        
        $svc = new ManagerService;
        $convert = new ActionToClass;
        
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
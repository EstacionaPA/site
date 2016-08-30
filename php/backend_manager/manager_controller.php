<?php

include 'manager_service.php';
include 'manager_abstract.php';
include 'to_action.php';

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
                echo 'Houve um erro na conversao do comando para a classe. Contacte o Suporte!';   
        }
        else
            echo 'nullFields';  
    }
}

?>
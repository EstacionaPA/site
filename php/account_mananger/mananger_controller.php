<?php

require 'mananger_service.php';

class ManangerController{
    
    public function __construct(){
        
        $svc = new ManangerService;
        
        $checkPostPerson = $svc->checkPost($_POST['pessoa']);
        $checkPostAction = $svc->checkPost($_POST['acao']);
        
        if($checkPostAction == 'done' and $checkPostPerson == 'done') {
            $person = $svc->getJSONPost($_POST['pessoa']);
                                                                //Used only in 'CadastroCliente' mode
            $class = $svc->convertActionToClass($_POST['acao'], $person);
    
            if($class <> 'dont'){            
                //the ManangerAbtstract are required in mananger_service.php
                ManangerAbstract::doAction($class, $svc, $person);
            }
            else 
                echo 'nullFields';   
        }
        else
            echo 'nullFields';  
    }
}

$init = new ManangerController();

?>
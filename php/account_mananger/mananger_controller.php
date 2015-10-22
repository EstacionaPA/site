<?php

require 'mananger_service.php';

class ManangerController{
    
    public function __construct(){
        
        $svc = new ManangerService;
        
        $checkPostPerson = $svc->checkPost($_POST['pessoa']);
        $checkPostAction = $svc->checkPost($_POST['acao']);
        
        if($checkPostAction == 'done' and $checkPostPerson == 'done') {
            $person = $svc->getJSONPost($_POST['pessoa']);
                                                                //Used only in CadastroCliente mode
            $class = $svc->convertActionToClass($_POST['acao'], $person);
            
            //Used when the controller needs to register new client
            
            
            if($class <> 'dont'){            
                //the ManangerAbtstract are implemented in the register_person.php when he is called in mananger_service.php
                ManangerAbtstract::doAction($class, $svc, $person);
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
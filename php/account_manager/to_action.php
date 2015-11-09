<?php

class ActionToClass{
    public function convert($action, &$person){
            
            if($action == 'cadastrar') {
                $class = new registerPersonController;
                return $class;
            }
            
            elseif($action == 'cadastrarCliente') {
                $class = new registerPersonController;
                
                //Similar to C/C++ pointer
                $person->access = 'c';
                return $class;
            }
            elseif($action == 'editar'){
                $class = new EditPersonController;
                return $class;
            }
            elseif($action == 'inativarPessoa'){
                $class = new InactivePerson;
                return $class;
            }
            else
                return 'dont';
        }
}

?>
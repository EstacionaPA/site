<?php

class registerPersonController extends ManagerAbstract{
    
    public function controll($person){
                    //required on to_action.php
        $svc = new AdminService;
        
        $checkValues = $svc->checkValues($person);
        if($checkValues == 'done'){
        
            $checkUser = $svc->checkSingleValue('CheckUser', $person['user']);
            $checkEmail = $svc->checkSingleValue('CheckEmail', $person['email']);
            $checkCPF = $svc->checkSingleValue('CheckCPF', $person['cpf']);
            
            if($checkUser == 'dont'){
                if($checkCPF == 'dont'){
                    if($checkEmail == 'dont'){
                        if($person['access'] != 'n'){
                        
                            //Criptografia da senha
                            $person['pass'] = md5($person['pass']);
                            
                            $register = $svc->register($person);
                            
                            if($register) echo 'success';
                            else echo $register;
                        }
                        elseif($person['access'] == 'n') echo 'acesso';
                    }
                    else echo 'email';
                }
                else echo 'cpf';
            }
            else echo 'user';
        }
        else echo 'nullFields';
    }
}

?>
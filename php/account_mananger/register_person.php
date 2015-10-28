<?php

class registerPersonController extends ManangerAbstract{
    
    public function controll(&$svc, $person){

        $checkValues = $svc->checkValues($person);
        if($checkValues == 'done'){

            $checkUser = $svc->checkSingleValue('CheckUser', $person->user);
            $checkEmail = $svc->checkSingleValue('CheckEmail', $person->email);
            $checkCPF = $svc->checkSingleValue('CheckCPF', $person->cpf);
            
            if($checkUser == 'dont'){
                if($checkCPF == 'dont'){
                    if($checkEmail == 'dont'){
                        if($person->access != 'n'){
                        
                            //Criptografia da senha
                            $person->senha = md5($person->senha);
                            
                            $register = $svc->register($person);
                            
                            if($register) echo 'success';
                            else echo $register;
                        }
                        elseif($person->access == 'n') echo 'acesso';
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
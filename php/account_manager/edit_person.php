<?php

class EditPersonController extends ManagerAbstract {
    
    public function controll(&$svc, $person){
        
        $checkUser = $svc->checkSingleValue('CheckUser', $person->usuario);
        $checkInactive = $svc->checkInactive($person->usuario);

        //Validation if user is not inactived
        if($checkInactive == 'done'){
            echo 'inactive';
            return;
        }

        //Validation for user field content
        if($checkUser == 'done'){
            
            //Validation if email already exist and the field content
            if($person->email != ''){
                $checkEmail = $svc->checkSingleValue('CheckEmail', $person->email);
                if($checkEmail == 'done'){
                    echo 'email';
                    return;
                }
            };
            
            //Check all the JSON values
            while($value = current($person)){
                //This conditional ignore JSON null values, null aceess value and user field
                if($value != 'n' and $value != '----NULO----' and key($person) != 'usuario'){
                    $update = $svc->update(key($person), $value, $person->usuario);
                    
                    if($update)
                        echo 'success';
                    else
                        'dont';
                    
                    return;
                       
                }
                next($person);
            }
            echo 'nullFields';
            return;
            
        }
        else
            echo '!user';
        
        
    }
    
    /*
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
    */
    
}

?>
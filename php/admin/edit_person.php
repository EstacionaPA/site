<?php

class EditPersonController extends ManagerAbstract {
    
    public function controll($person){
                    //required on to_action.php
        $svc = new AdminService;
        
        $checkUser = $svc->checkSingleValue('CheckUser', $person['usuario']);
        $checkInactive = $svc->checkInactive($person['usuario']);

        //Validation if user is not inactived
        if($checkInactive == 'done'){
            echo 'inactive';
            return;
        }

        //Validation for user field content
        if($checkUser == 'done'){
            
            //Validation if email already exist and the field content
            if($person['email'] != ''){
                $checkEmail = $svc->checkSingleValue('CheckEmail', $person['email']);
                if($checkEmail == 'done'){
                    echo 'email';
                    return;
                }
            };
            
            //Check all the JSON values
            echo count($person) . ';';
            print_r($person);
            //while($value = current($person)){
            for($i = 0; $i < count($person); $i = $i + 1){
                echo 'contagem: ' . count($person) . ';';
                $value = current($person);
                echo 'valor: ' . $value . ';';
                echo 'loop:' . $i . ';';
                //This conditional ignore JSON null values, null aceess value and user field
                if($value != 'n' and $value != '----NULO----' and key($person) != 'usuario'){

                    $update = $svc->update(key($person), $value, $person['usuario']);
                    
                    if($update)
                        echo ';' . $update;
                    else
                        'dont';
                }
                
                //array_shift($person);
                next($person);
            }
            echo 'nullFields';
            return;
            
        }
        else
            echo '!user';
        
        
    }
    
}

?>
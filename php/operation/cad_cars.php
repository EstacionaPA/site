<?php

class RegisterCar {
    public function controll($form){

        if($form['user'] == '' || $form['placa'] == '' || 
           $form['idMarca'] == '' || $form['idModelo'] == '') {
                echo '!fields';
                return;
        }

        $validUser = SqlController::Validate('CheckUser', $form['user']);
        $validMarca = SqlController::Validate('CheckIDMark', $form['idMarca']);
        $validModelo = SqlController::Validate('CheckIDModel', $form['idModelo']);
        $validPlaca = SqlController::Validate('CheckBoard', $form['placa']);

        if($validUser == 'done'){//1
        if($validMarca == 'done'){//2
        if($validModelo == 'done'){//3
        if($validPlaca == 'dont'){//4

            $form['idUser'] = SqlController::Request('RequestIdUser', $form['user']);        
            $valid = SqlController::Insert('insertCar', $form);

            if($valid) echo 'done';
            else echo $valid;
        
        }//4
        else
            echo 'placa';

        }//3
        else
            echo '!modelo';

        }//2
        else
            echo '!marca';

        }//1
        else
            echo '!user';
            
    }
}
?>
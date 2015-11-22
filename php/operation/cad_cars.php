<?php

require 'php/objects/car.php';

class RegisterCar {
    public function controll($form){

        if($form['user'] == '' || $form['placa'] == '' || 
           $form['marca'] == '' || $form['modelo'] == '') {
                echo '!fields';
                return;
        }

        $validUser = SqlController::Validate('CheckUser', $form['user']);
        $validMarca = SqlController::Validate('CheckMark', $form['marca']);
        $validModelo = SqlController::Validate('CheckModel', $form['modelo']);
        $validPlaca = SqlController::Validate('CheckBoard', $form['placa']);

        if($validUser == 'done'){
            if($validMarca == 'done'){
                if($validModelo == 'done'){
                    if($validPlaca == 'dont'){


                        $idUser= SqlController::Request('RequestIdUser', $form['user']);
                        $modelo = SqlController::Request('RequestIdModel', $form['modelo']);
                        $marca = SqlController::Request('RequestIdMark', $form['marca']);

                        $car = new Car($idUser, $form['placa'], $marca, $modelo);

                        $valid = SqlController::Insert('insertCar', $car);

                        if($valid) echo 'done';
                        else echo $valid;
                    }

                    else{
                        echo 'placa';
                        return;
                    }
                }

                else{
                    echo '!modelo';
                    return;
                }
            }

            else{
                echo '!marca';
                return;
            }
        }

        else{
            echo '!user';
            return;
        }
    }
}
?>
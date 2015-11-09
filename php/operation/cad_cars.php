
<?php

require '../SQL/sql_controller.php';
require '../objects/car.php';

if($_POST['user'] == '' || $_POST['placa'] == '' || 
   $_POST['marca'] == '' || $_POST['mod'] == '') {
        echo '!fields';
        return;
}

$postUser = $_POST['user'];
$postPlaca = $_POST['placa'];
$postMarca = $_POST['marca'];
$postMod = $_POST['mod'];

$validUser = SqlController::Validate('CheckUser', $postUser);
$validMarca = SqlController::Validate('CheckMark', $postMarca);
$validModelo = SqlController::Validate('CheckModel', $postMod);
$validPlaca = SqlController::Validate('CheckBoard', $postPlaca);
    
if($validUser == 'done'){
    if($validMarca == 'done'){
        if($validModelo == 'done'){
            if($validPlaca == 'dont'){
                

                $idUser= SqlController::Request('RequestIdUser', $postUser);
                $modelo = SqlController::Request('RequestIdModel', $postMod);
                $marca = SqlController::Request('RequestIdMark', $postMarca);
                
                $car = new Car($idUser, $postPlaca, $marca, $modelo);

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

?>
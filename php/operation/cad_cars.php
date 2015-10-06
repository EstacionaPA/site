
<?php

require '../sql_service.php';
require '../objects.car.php';

if($_POST["user"] == "" || $_POST["placa"] == "" || 
   $_POST["marca"] == "" || $_POST["mod"] == "") {
        echo "!fields";
        return;
}

$postUser = $_POST["user"];
$postPlaca = $_POST["placa"];
$postMarca = $_POST["marca"];
$postMod = $_POST["mod"];

$validUser = SqlController::validate('CheckUser', $postUser);
$validMarca = SqlController::validate('CheckMark', $postMarca);
$validModelo = SqlController::validate('CheckModel', $postMod);
$validPlaca = SqlController::validate('CheckBoard', $postPlaca);
    
if($validUser == "valido"){
    if($validMarca == "valido"){
        if($validModelo == "valido"){
            if($validPlaca == "invalido"){
                

                $idUser= SqlController::Request('RequestIdUser', $postUser);
                $modelo = SqlController::Request('RequestIdModel', $postMod);
                $marca = SqlController::Request('RequestIdMark', $postMarca);
                
                $car = new Car($user, $postMarca, $marca, $modelo);
                
                $valid = SqlController::Insert('InsertCar', $car);
                
                if($valid) echo "added";
                else echo $valid;
            }
            
            else{
                echo "placa";
                return;
            }
        }
        
        else{
            echo "!modelo";
            return;
        }
    }
        
    else{
        echo "!marca";
        return;
    }
}

else{
    echo "!user";
    return;
}

?>
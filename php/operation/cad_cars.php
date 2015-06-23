<?php

include_once('../sql_commands.php');
include_once('../google/analyticstracking.php');

if($_POST["user"] == "" || $_POST["placa"] == "" || 
   $_POST["marca"] == "" || $_POST["mod"] == "") {
        echo "!fields";
        return;
}

$postUser = $_POST["user"];
$postPlaca = $_POST["placa"];
$postMarca = $_POST["marca"];
$postMod = $_POST["mod"];

$validUser = checkUser($postUser);
$validMarca = checkMarca($postMarca);
$validModelo = checkModelo($postMod);
$validPlaca = checkPlaca($postPlaca);
    
if($validUser == "existe"){
    if($validMarca == "existe"){
        if($validModelo == "existe"){
            if($validPlaca == "nao existe"){
                
                $user= requestIDUser($postUser);
                $modelo = requestIDModelo($postMod);
                $marca = requestIDMarca($postMarca);

                $valid = insertCar($user, $postPlaca, $marca, $modelo);
                
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
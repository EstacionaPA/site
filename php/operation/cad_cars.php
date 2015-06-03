<?php

include_once('../sql_commands.php');

if($_POST["user"] == "" || $_POST["placa"] == "" || 
   $_POST["marca"] == "" || $_POST["mod"] == "") {
        echo "!fields";
        return;
}

$user = $_POST["user"];
$placa = $_POST["placa"];
$marca = $_POST["marca"];
$mod = $_POST["mod"];

if(1){
    if(checkPlaca($placa) == "nao existe"){
        if(checkMarca($marca) == "existe"){
            if(checkModelo($mod) == "existe"){
                $valid = registerCar(1, $placa, 2, 2);
                if($valid) echo $valid;
                else echo $valid;
                return;
                
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
        echo "placa";
        return;
    }
}

else{
    echo "!user";
    return;
}

?>
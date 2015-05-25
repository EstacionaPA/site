<?php
    
include_once('../sql_commands.php');

$vetData = array();
$valid = "3";

$vetData[0] = $_POST["user"];
$vetData[1] = "acesso";
$vetData[2] = $_POST["access"];
$vetData[3] = "telefone";
$vetData[4] = $_POST["tel"];
$vetData[5] = "celular";
$vetData[6] = $_POST["cel"];
$vetData[7] = "email";
$vetData[8] = $_POST["email"];
$vetData[9] = "endereco";
$vetData[10] = $_POST["end"];
$vetData[11] = "complemento";
$vetData[12] = $_POST["comp"];
$vetData[13] = "numero";
$vetData[14] = $_POST["num"];
$vetData[15] = "cep";
$vetData[16] = $_POST["cep"];
$vetData[17] = "cidade";
$vetData[18] = $_POST["city"];
$vetData[19] = "estado";
$vetData[20] = $_POST["state"];

if($vetData[0] == ""){
    echo "noUserField";
    return;
}

for($i = 1; $i < 22; $i = $i + 2) {  
    
    if(isset($vetData[$i + 1]) && $vetData[$i + 1] != "" && $vetData[$i + 1] != "n"){
        
        $check = checkUser($vetData[0]);
    
        if($check == "existe")
            $valid = updateUser($vetData[0], $vetData[$i], $vetData[$i+1]);

        else
            $valid = "4";
    }
}


if($valid==1)
    echo "success";

else if($valid == "3")
    echo "nullFields";
    
else if($valid == "4")
    echo "!user";
    
else
    echo $valid;

?>
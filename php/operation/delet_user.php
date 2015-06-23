<?php

include_once('../sql_commands.php');
include_once('../google/analyticstracking.php');

//Validação
if(isset($_POST["user"]) && $_POST["user"] != ""){
    
    $user = $_POST["user"];
    
    $check = checkUser($user);
    
    if($check == "existe"){
        
        //Requisita o deletar de um usuário
        $delet = deletUser($user);
        
        if($delet == "ok"){
            echo "success";
            return;
        }
        else
            echo $delet;
            return;
    }
    
    else{
        echo "!user";
        return;
    }
}

else
    echo "nullField";

?>
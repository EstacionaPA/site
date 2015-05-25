<?php

include_once('../sql_commands.php');

if(isset($_POST["user"]) && $_POST["user"] != ""){
    
    $user = $_POST["user"];
    
    $check = checkUser($user);
    
    if($check == "existe"){
        
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
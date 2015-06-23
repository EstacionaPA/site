<?php

include_once("../sql_commands.php");

session_start();

if(isset($_SESSION["login"])){
    
    $usuario = requestName($_SESSION['login']);
    echo $usuario;

}

else 
    echo "Realizar login";

?>
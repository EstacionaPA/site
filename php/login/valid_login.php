<?php

include_once('../sql_commands.php');

//Valida os $_POST
if(!isset($_POST['user']) || !isset($_POST['pass'])){
    echo 3;
    return 0;
}

$user = addslashes($_POST['user']);
$pass = addslashes($_POST['pass']);

//Valida se estão preenchidos
if($user == '' || $pass == ''){
    echo "nullFields";
    return 0;
}

//Requisita validação de usuário e senha
$validation = checkUserPass($user, md5($pass));

if($validation == "existe"){
    session_start();
    //Abre uma nova sessão
    $_SESSION['login'] = $user;
    echo "success";
}
else if($validation == "no")
    echo "!user!pass";

else
    echo 'Nothing here, man...';
?>
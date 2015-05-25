<?php

include_once('../sql_commands.php');

if(!isset($_POST['user']) || !isset($_POST['pass'])){
    echo 3;
    return 0;
}

$user = $_POST['user'];
$pass = $_POST['pass'];

if($user == '' || $pass == ''){
    echo "nullFields";
    return 0;
}

$validation = requestUser($user, md5($pass));

if($validation == "existe"){
    session_start();
    $_SESSION['login'] = $user;
    echo "success";
}
else if($validation == "no")
    echo "!user!pass";

else
    echo 'Nothing here, man...';
?>
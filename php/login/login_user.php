<?php

include_once('../operation/sql_central.php');

if(!isset($_POST['user']) || !isset($_POST['pass'])){
    echo 3;
    return 0;
}

$user = $_POST['user'];
$pass = $_POST['pass'];

if($user == '' || $pass == ''){
    echo 3;
    return 0;
}

$validation = requestUser($user, md5($pass));

if($validation == '1'){
    session_start();
    $_SESSION['login'] = $user;
    echo 1;
}
else if($validation == '2')
    echo 2;

else
    echo 'Nothing here, man...';
?>
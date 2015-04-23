<?php
//inicia sessão
session_start();

//testa se a variável usuario está setada
if(! $_SESSION['usuario'])
    echo "<script> document.location = '../forms/login.html' </script>";

?>
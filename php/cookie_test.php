<?php

//testa se o cookie do login está setada

if(! isset($_COOKIE['loginIn']))
    echo "<script> document.location = '../forms/login.html' </script>";


?>
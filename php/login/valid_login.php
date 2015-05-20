<?php

include_once('../operation/sql_central.php');

session_start();
$doc = new DOMDocument();

if(isset($_SESSION['login'])){
    
    if($_SESSION['login'] != ''){

        $access = requestAccess($_SESSION['login']);
        
        if($access == 'a'){
            header('location: ../../html/operation/login/main_login_a.html');
        }
        else if($access == 'f'){
            header('location: ../../html/operation/login/main_login_f.html');
        }
        else{
            header('location: ../../html/operation/login/main_login_c.html');
        }
    }
    else{
        header('location: ../../html/operation/login/form_login.html');
    }
}
else {
    header('location: ../../html/operation/login/form_login.html');
}

?>
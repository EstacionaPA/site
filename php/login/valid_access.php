<?php

include_once('../sql_commands.php');

session_start();
$doc = new DOMDocument();

if(isset($_SESSION['login']) ){
    
    //Requisita Acesso
    $access = requestAccess($_SESSION['login']);
    
    //Faz a separação
    accessNow($access);
    
    /* IMPLEMENTAR
    if($_POST['testAccess'] != '')

    }
    else
    header('location: ../../html/operation/login/form_login.html');
    */
}
else 
    header('location: ../../html/forms/form_login.html');


function accessNow($access){
    
    if($access == 'a')
        header('location: ../../html/pages/main_login_a.html');

    else if($access == 'f')
        header('location: ../../html/pages/main_login_f.html');

    else if($access == 'c')
        header('location: ../../html/pages/main_login_c.html');

    else
        header('location: ../../html/forms/form_login.html');
}
?>
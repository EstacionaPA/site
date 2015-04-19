<?php
include_once('../config/conexao_local.php');
if(isset($_GET['action']))
{        
   if($_GET['action']=="reset")
    {
        $encrypt = mysql_real_escape_string($_GET['action']);
        $query = "SELECT id FROM pessoas where md5(1290*3+id)='".$encrypt."'";
        $result = mysql_query($query);
        $Results = mysql_fetch_array($result);
        if(count($Results)>=1)
        {
 			echo 'teste';
        }
        else
        {
            echo 'Invalid key please try again. <a href="http://demo.phpgang.com/login-signup-in-php/#forget">Forget Password?</a>';
        }
    }
}
elseif(isset($_POST['action']))
{


 
 $encrypt = mysql_real_escape_string($_GET['encrypt']);
 $senha1 = isset($_POST['senha1']) ? $_POST['senha1'] : null;
 $senha2 = isset($_POST['senha2']) ? $_POST['senha2'] : null;
 $criptografada = md5($senha1);
  
    
    $query = "SELECT id FROM pessoas where md5(1290*3+id)=''".$encrypt."'";
 
    $result = mysql_query($query);
    $Results = mysql_fetch_array($result);
    if(count($Results)>=1)
    {
        $query = "update pessoas set senha='".md5($criptografada)."' where id='".$Results['id']."'";
        mysql_query($query);
 
        echo  "Your password changed sucessfully <a href=\"http://demo.phpgang.com/login-signup-in-php/\">click here to login</a>.";
    }
    else
    {
     echo   'Invalid key please try again. <a href="http://demo.phpgang.com/login-signup-in-php/#forget">Forget Password?</a>';
    }

}
?>

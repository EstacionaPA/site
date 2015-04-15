<?php

 include_once('../config/conexao_remoto.php');

 
 $email = isset($_POST['email']) ? $_POST['email'] : null;


        $sql = "SELECT id FROM pessoas where email='$email'";
        $res = mysql_query($sql);
		$row = mysql_fetch_array($res);
 
        if( $row[0] > 0 ){	
        
           	echo "<script> alert ('Foi enviado um link no seu e-mail para redefinição de senha!'); </script>";

            $encrypt = md5(1290*3+$row['id']);
            $message = "Your password reset link send to your e-mail address.";
            echo "$message";
            $to=$email;
            $subject="Redefinição de Senha";
            $from = 'password@estacionapa.com';
            $body ='Olá, <br/> <br/><br><br>Clique aqui para resetar sua senha www.estacionapa.com/recuperar.php?encrypt='.$encrypt.'&action=reset   <br/>';
            $headers = "From: password@estacionapa.com" . strip_tags($from) . "\r\n";
            $headers .= "Reply-To: password@estacionapa.com". strip_tags($from) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
 
            mail($to,$subject,$body,$headers);
        }
        else
        {
            echo "<script> alert ('Email não cadastrado na base de dados'); </script>";
        }
    

?>
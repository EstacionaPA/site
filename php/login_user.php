<?php

include_once('modo_acesso.php');

	//Inicia Sessão
	session_start();
	//Captura usuário e senha passados pela função do Jquery por POST
	$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : null;
	$senha = isset($_POST['senha']) ? $_POST['senha'] : null;

 		//puxa do login.html o usuario e senha inseridos
		$usuario = $_POST["usuario"];
		$senha = $_POST["senha"];
		$criptografada = md5($senha);


 
        //Executa o select para buscar no banco se existe o usuario e a senha inseridos
		$sql = "SELECT count(*) FROM pessoas WHERE(
		        usuario ='$usuario' 
				AND 
				senha ='$criptografada')";
 			
 		//retorna a query
	    $res = mysql_query($sql);
		$row = mysql_fetch_array($res);
 		
		//se existir o usuario, retornara uma coluna, ou seja > 0

		if( $row[0] > 0 ){
		 echo "<script> alert ('Login com Sucesso, você está sendo redirecionado'); </script>";
			$_SESSION['usuario'] = $usuario;
            //fclose('location: ../forms/login.html');
            //header('location: ../login/loginAdmin.php');
			echo "<script> document.location = 'http://estacionapa.com/login/loginAdmin.php' </script>";
		}
		else
		 echo "<script> alert ('Usuário ou Senha Inválidos'); </script>";
   			
?>
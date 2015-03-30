<?php

 include_once('../config/conexao_remoto.php');

 		//puxa do login.html o usuario e senha inseridos
		$usuario = $_POST["usuario"];
		$senha = $_POST["senha"];
 
        //Executa o select para buscar no banco se existe o usuario e a senha inseridos
		$sql = "SELECT count(*) FROM pessoas WHERE(
		        usuario ='$usuario' 
				AND 
				senha ='$senha')";
 			
 		//retorna a query
	    $res = mysql_query($sql);
		$row = mysql_fetch_array($res);
 		
		//se existir o usuario, retornara uma coluna, ou seja > 0
		if( $row[0] > 0 )
		 echo "Login efetuado com sucesso";
		else
		 echo "Usuário ou senha inválidos";
   			
?>
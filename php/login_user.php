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
    $sqlUser = "SELECT count(*) FROM pessoas 
                  WHERE( usuario ='$usuario' 
                            AND 
                         senha ='$criptografada'
                       )";
    
    //Executa a consulta para buscar o acesso do usuario
    $sqlAccess = "SELECT acesso FROM pessoas
                  WHERE usuario = '$usuario'";
                  
                    
    $resultUser = mysql_query($sqlUser);
    $row = mysql_fetch_array($resultUser);

    $resultAccess = mysql_query($sqlAccess);
    $stringResult = mysql_result($resultAccess, 0);
    
    
 		
    //se existir o usuario, retornara uma coluna, ou seja > 0

    if( $row[0] > 0 )
    {   
        
        
    
        echo "<script> alert ('Login com Sucesso, você está sendo redirecionado'); </script>";
        
        $_SESSION['usuario'] = $usuario;
        
        if ($stringResult == "a") 
        {
            
            echo "<script> document.location = '../login/login_admin.php' </script>"; 
            
        }

        elseif ($stringResult == "f")
        {
            echo "<script> document.location = '../login/login_func.php' </script>";
        }
    
        else 
        {
            echo "<script> document.location = '../login/login_client.php' </script>";
            
        }
        
        
    }
		else
		 echo "<script> alert ('Usuário ou Senha Inválidos'); </script>";
   			
?>
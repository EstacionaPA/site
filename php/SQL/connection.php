<?php 
// Conexao com o banco de dados
class Connection{
    
    public function Conn ($network){

        if($network == "local"){
            /*
            $conexao = mysql_pconnect("localhost","root","") or die ("Erro na conexão!");
            $banco = mysql_select_db("projeto");
            */
            $servidor = 'localhost';
            $usuario = 'root';
            $senha = '';
            $banco = 'projeto';

            $mysqli = new mysqli($servidor, $usuario, $senha, $banco);
            
            if ($mysqli->connect_errno) {
                echo 'Erro de Conexao: ' . $mysqli->connect_error . '.';
                $mysqli->close();
                return NULL;
            }
            

            return $mysqli;
            
        }
        
        elseif($network == "localServer"){
            $servidor = 'localhost';
            $usuario = 'u650072308_site';
            $senha = 'x3Lae6vUSI';
            $banco = 'u650072308_site';

            $mysqli = new mysqli($servidor, $usuario, $senha, $banco) or die ("Erro na conexão!");

        }
        
    }

}
?>
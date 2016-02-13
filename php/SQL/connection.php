<?php 
// Conexao com o banco de dados
class Connection{
    
    public function Conn ($network){

        if($network == "local"){
            $servidor = 'localhost';
            $usuario = 'root';
            $senha = 'snake007';
            $banco = 'projeto';

            $mysqli = new mysqli($servidor, $usuario, $senha, $banco) or die ("Erro na conexão!");
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
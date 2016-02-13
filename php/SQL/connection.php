<?php 
// Conexao com o banco de dados
class Connection{
    
    public function Conn ($network){

        if($network == "local"){
            $conexao = mysqli_pconnect("localhost","root","snake007") or die ("Erro na conexão!");
            $banco = mysqli_select_db("projeto");
        }
        
        elseif($network == "localServer"){
            $conexao = mysqli_pconnect("localhost","u650072308_site","x3Lae6vUSI") or die ("Erro na conexão!");
            $banco = mysqli_select_db("u650072308_site");
        }
        
    }

}
?>
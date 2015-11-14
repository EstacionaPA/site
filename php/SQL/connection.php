<?php 
// Conexao com o banco de dados
class Connection{
    
    public function Conn ($network){
    
        if ($network == "remoto") {
            
            $conexao = mysql_pconnect("192.186.234.65","alfredudu","Sn@keDoctor_007") or die ("Erro na conexão!");
            $banco = mysql_select_db("projeto");
        }
        elseif($network == "local"){
            $conexao = mysql_pconnect("localhost","root","") or die ("Erro na conexão!");
            $banco = mysql_select_db("projeto");
        }
        
        elseif($network == "localServer"){
            $conexao = mysql_pconnect("localhost","alfredudu","Sn@keDoctor_007") or die ("Erro na conexão!");
            $banco = mysql_select_db("estacionapa");
        }
        
    }

}
?>
<?php 
// Conexao com o banco de dados
class Connection{
    
    public function Conn ($network){

        if($network == "local"){
            $conexao = mysql_pconnect("localhost","root","snake007") or die ("Erro na conexão!");
            $banco = mysql_select_db("estacionapa");
        }
        
        elseif($network == "localServer"){
            $conexao = mysql_pconnect("localhost","alfredudu","Sn@keDoctor_007") or die ("Erro na conexão!");
            $banco = mysql_select_db("estacionapa");
        }
        
    }

}
?>
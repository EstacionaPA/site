<?php

include_once('../sql_commands.php');

$array = array();

//Verifica se os campos foram setados e verifica também se eles foram preenchidos
if(isset($_POST["name"])){
    if( $_POST["name"] != ""){
        
        //busca as informaçõos do usuário por uma data
        $array = relatInfUser($_POST["name"]);
         
        //gera a informação para o javascript
        while($row = mysql_fetch_row($array))
            
            foreach($row as $cell)
                echo $cell .  ";";
        
        if(!$array){
            echo "noData" ;
            return;
        }
        
        //gera a informação para o javascript
        for($i = 0; $i < 6; $i++)
            echo $array[$i] .";";
        
        return;
    }
    echo "noUserDateFields";
}
else
   echo "noUserDateFields";

?>
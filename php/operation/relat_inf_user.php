<<<<<<< HEAD
<?php
=======
﻿<?php
>>>>>>> 49f0e2e095a930cf7a893072ec7c09c8c2fe7281

include_once('../sql_commands.php');

$array = array();

//Verifica se os campos foram setados e verifica também se eles foram preenchidos
if(isset($_POST["name"])){
    if( $_POST["name"] != ""){
        
        //busca as informaçõos do usuário por uma data
        $array = relatInfUser($_POST["name"]);
<<<<<<< HEAD
         
        //gera a informação para o javascript
        while($row = mysql_fetch_row($array))
            
            foreach($row as $cell)
                echo $cell .  ";";
=======
        
        if(!$array){
            echo "noData" ;
            return;
        }
        
        //gera a informação para o javascript
        for($i = 0; $i < 6; $i++)
            echo $array[$i] .";";
>>>>>>> 49f0e2e095a930cf7a893072ec7c09c8c2fe7281
        
        return;
    }
    echo "noUserDateFields";
}
else
   echo "noUserDateFields";

?>
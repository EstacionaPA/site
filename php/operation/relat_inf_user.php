<?php

require '../SQL/sql_controller.php';

$array = array();

//Verifica se os campos foram setados e verifica também se eles foram preenchidos
if(isset($_POST["name"])){
    if( $_POST["name"] != ""){
        
        //busca as informaçõos do usuário por uma data
        $array = SqlController::Report('InfUser', $_POST['name']);
         
        //gera a informação para o javascript
        while($row = mysql_fetch_row($array))
            
        foreach($row as $cell)
                echo $cell .  ";";
        
        return;
    }
    echo "noUserDateFields";
}
else
    echo "noUserDateFields";

?>
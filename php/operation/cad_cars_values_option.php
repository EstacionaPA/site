<?php

include_once('../sql_commands.php');

$array = array();

//VALIDAÇÃO CONTRA MANUSEIO POR PARTE DO USUARIO NO JAVASCRIPT
if(isset($_POST["request"])){
    
    $requisitonType = $_POST["request"];
    
    if($requisitonType == "mark"){
        
        //REQUISITANDO A LISTA DE MARCAS
        $array = requestMark();
        
        //MONTANDO A STRING PARA O JAVA SCRIPT
        while($row = mysql_fetch_row($array))
            
        foreach($row as $option)
            echo $option .  ";";
            
        return;
    }

    else if($requisitonType == "model"){
        
        //VALIDAÇÃO CONTRA MANUPULAÇÃO DO JAVASCRIPT POR PARTE DO USUARIO
        if(!isset($_POST["markValue"])) {
            echo "Erro!";
            return;
        }
        else{
            
            $markValue = $_POST["markValue"];
            
            //VALIDAÇÃO PARA QUE, QUANDO O USUARIO RETORNAR O VALOR DA MARCA EM INICIAL, FAÇA NADA
            IF($markValue == "nothing") return;
            
            $array = requestModel($markValue);
            
            while($row = mysql_fetch_row($array))

            foreach($row as $option)
                echo $option .  ";";

            return;
        }
    }

}
echo "Erro!";
?>
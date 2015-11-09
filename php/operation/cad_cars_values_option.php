<?php

require '../SQL/sql_controller.php';

$array = array();

//secrurity
if(isset($_POST["request"])){
    
    $requisitonType = $_POST["request"];
    
    if($requisitonType == "mark"){
        
        //REQUISITANDO A LISTA DE MARCAS
        $resource = SqlController::Request('RequestMarks', NULL);
        
        while($row = mysql_fetch_row($resource))

            foreach($row as $option)
                echo $option .  ";";
        
        return;
    }

    else if($requisitonType == "model"){
        
        //VALIDAÇÃO CONTRA MANUPULAÇÃO DO JAVASCRIPT POR PARTE DO USUARIO
        if(!isset($_POST["markName"])) {
            echo "Erro!";
            return;
        }
        else{
            
            $markName = $_POST["markName"];
            
            //VALIDAÇÃO PARA QUE, QUANDO O USUARIO RETORNAR O VALOR DA MARCA EM INICIAL, FAÇA NADA
            if($markName == "nothing") return;
            
            $markId = SqlController::Request('RequestIdMark', $markName);
            $array = SqlController::Request('RequestModels', $markId);
            
            while($row = mysql_fetch_row($array))

            foreach($row as $option)
                echo $option .  ";";

            return;
        }
    }

}
echo "Erro!";
?>
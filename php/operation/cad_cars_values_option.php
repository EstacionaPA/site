<?php

require '../SQL/sql_controller.php';

$array = array();

//secrurity
if(isset($_POST["request"])){
    
    $requisitonType = $_POST["request"];
    
    if($requisitonType == "mark"){
        
        //REQUISITANDO A LISTA DE MARCAS
        $resource = SqlController::Request('RequestMarks', NULL);
        
        if($resource)    
            for($i = 0; $i < count($resource); $i = $i + 1) echo $resource[$i][0] . ';';
            
        else
            return NULL;
        
    }

    else if($requisitonType == "model"){
        
        //VALIDAÇÃO CONTRA MANUPULAÇÃO DO JAVASCRIPT POR PARTE DO USUARIO
        if(!isset($_POST["markName"])) {
            echo "Informe uma Marca.";
            return NULL;
        }
        else{
            
            $markName = $_POST["markName"];
            
            //VALIDAÇÃO PARA QUE, QUANDO O USUARIO RETORNAR O VALOR DA MARCA EM INICIAL, FAÇA NADA
            if($markName == "nothing") return;
            
            $markId = SqlController::Request('RequestIdMark', $markName);
            $array = SqlController::Request('RequestModels', $markId);
            
            if($array)  
                for($i = 0; $i < count($array); $i = $i + 1) echo $array[$i][0] . ';';
            
            return NULL;
        }
    }

}
echo "Erro geral.";
?>
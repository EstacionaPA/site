<?php
    
include("../sql_commands.php");

$board = addslashes($_POST["board"]);
$i=0;

if(isset($board)){
    
        //busca as informaçõos do usuário por uma data
        $result = relatBordXCar($board);
        $array = mysql_fetch_array($result);
    
        if($array == "") return "";
        
        for($i; $i < 4; $i = $i+1)
            echo $array[$i]. ";";
        
}

else
    echo "noUserDateFields";


?>
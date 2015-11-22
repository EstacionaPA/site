<?php

class ReportBoardXCard{
    public function controll($board){
        
        $board = addslashes($board);
        $i=0;

        if(isset($board)){
            
            //Find informations
            $result = SqlController::Report('BoardXCar', $board);
            $array = mysql_fetch_array($result);
        
            if($array == '') return '';
            
            for($i; $i < 4; $i = $i+1)
                echo $array[$i]. ';';
        }
        
        else
            echo "noUserDateFields";
    }
}




?>
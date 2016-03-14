<?php

class ReportBoardXCard{
    public function controll($board){
        
        $board = addslashes($board);
        $i=0;

        if(isset($board)){
            
            //Find informations
            $result = SqlController::Report('BoardXCar', $board);
            
            if(count($result) == 0) return NULL; 
            
            for($i=0; $i < count($result); $i = $i+1){
                                   //COLUMNS NUMBER OF SQL
                    for($l=0; $l < 4; $l = $l+1)
                        echo $result[$i][$l] . ';';
                }
            
            return NULL;
        }
        
        else
            echo "noUserDateFields";
    }
}




?>
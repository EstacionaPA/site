<?php

class ReportBoardXCard{
    public function controll($board){
        
        $board = addslashes($board);
        $i=0;

        if(isset($board)){
            
            //Find informations
            $result = SqlController::Report('BoardXCar', $board);
            
            if(count($result) == 0) return NULL; 
            
            echo json_encode($result);
        }
        
        else
            echo "noUserDateFields";
    }
}




?>
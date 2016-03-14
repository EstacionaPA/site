<?php

class ReportInfUser {
    public function controll($name){
        
        $array = array();
    
        //Check the content field
        if(isset($name)){
            if( $name != ""){
                
                //Find information of user
                $result = SqlController::Report('InfUser', $name);
                
                if(count($result) == 0) return NULL; 
                
                for($i=0; $i < count($result); $i = $i+1){
                                   //COLUMNS NUMBER OF SQL
                    for($l=0; $l < 6; $l = $l+1)
                        echo $result[$i][$l] . ';';
                }   
                
                return NULL;
            }
            echo "noUserDateFields";
        }
        else
            echo "noUserDateFields";
        
                
    }
    
}


?>
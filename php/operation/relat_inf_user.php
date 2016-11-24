<?php

class ReportInfUser {
    public function controll($name){
        
        $array = array();
    
        //Check the content field
        if(isset($name)){
            if( $name != ""){
                
                //Find information of user
                $result = SqlController::Report('InfUser', $name);
                
                if(count($result) == 0) return '!data'; 
                
                echo json_encode($result);
                
                return NULL;
            }
            echo "noUserDateFields";
        }
        else
            echo "noUserDateFields";
        
                
    }
    
}


?>
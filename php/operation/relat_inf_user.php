<?php

class ReportInfUser {
    public function getInformations($name){
        
        $array = array();

        //Check the content field
        if(isset($name)){
            if( $name != ""){
                
                //Find information of user
                $array = SqlController::Report('InfUser', $name);
                 
                //Get and construct information to javascript
                while($row = mysql_fetch_row($array))
                    
                foreach($row as $cell)
                        echo $cell .  ";";
                
                return;
            }
            echo "noUserDateFields";
        }
        else
            echo "noUserDateFields";
        
                
    }
    
}


?>
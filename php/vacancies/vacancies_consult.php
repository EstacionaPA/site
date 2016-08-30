<?php

class VacanciesConsult extends ManagerAbstract{
  public function controll($filters){
    
    $service = new VacanciesServices;
       
     if((isset($filters['hora_reserva']) and $filters['hora_reserva'] != '') and
        (isset($filters['hora_fim']) and $filters['hora_fim'] != '') and
        (isset($filters['data']) and $filters['data'] != '')){
                
            $validDate = $service->checkDate($filters['data'], $filters);
            $validHour = $service->checkHour($filters['hora_reserva'],
                                             $filters['hora_fim']);
            if($validDate == 'done'){//1
            if($validHour == 'done'){//2
            if($filters['hora_reserva'] < $filters['hora_fim']){//3
                
                $result = $service->requestSomeDataReserves($filters);

                if(count($result) == 0){
                    echo 'empty';
                    return 0;
                }
                else{
                    for($i = 0; $i < count($result); $i++){
                        $feedback = NULL;
                        $feedback = $service->checkResult($result, $filters, $i);
                        if($feedback == NULL){
                            unset($result[$i]);
                            $result = array_values($result); //REINDEX ARRAY
                            $i--;
                        }
                    }
                }
                
                if(count($result) == 0)
                    echo 'empty';
                else
                    echo json_encode($result);
                
            }else//3
                echo '!validHour';
            }//2
            else
                echo '!validHour';
            }//1
            else
                echo '!validDate';
               
        }
        else
            echo '!validObject';
             
    }
    
}

?>
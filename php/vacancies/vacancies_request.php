<?php

class VacanciesRequest extends ManagerAbstract{
  public function controll($object){
    
    $service = new VacanciesServices;
    $user = '';
    $validDate = '';
    $validCar = '';
    $validHour = '';
    $vagas = '';
    $result = '';
    $validIdCar = '';
    $feedBack = '';
    $validHourFunc = '';

     if((isset($object['id_carro']) and $object['id_carro'] != '') and
        (isset($object['id_estac']) and $object['id_estac'] != '') and
        (isset($object['vaga']) and $object['vaga'] != '') and
        (isset($object['usuario']) and $object['usuario'] != '') and
        (isset($object['hora_reserva']) and $object['hora_reserva'] != '') and
        (isset($object['hora_fim']) and $object['hora_fim']) != '' and
        (isset($object['data']) and $object['data'] != '')){
/*
            if((isset($object['vaga']) and $object['vaga'] != '')){
                $restVacancies[] = SqlController::Request('RequestRestReserves', $object);
                
                for($i = 0; $i<count($restVacancies); $i++){
                    if($restVacancies[$i]['vaga'])
                }
            }
            */
            $object['id_pessoa'] = $service->requestIdUser($object['usuario']);
            $validDate = $service->checkDate($object['data'], $object);
            $validHour = $service->checkHour($object['hora_reserva'],
                                             $object['hora_fim']);
            $validIdCar = $service->checkIdCar($object['id_carro']);
            $vagas = $service->requestMaxVacancies($object['id_estac']);
            $validHourFunc = $service->checkHourFunc($object);
         
            if($object['vaga'] <= $vagas['vagas'] and 
                            $object['vaga'] > 0){//1
            if($validIdCar == 'done'){//2
            if($validDate == 'done'){//3
            if($validHour == 'done'){//4
            if($validHourFunc == 'done'){//5
                
                $result = $service->requestVacancies($object);

                if(count($result) == 0){
                    $service->registerVacancy($object);
                    echo 'done';
                }
                else{
                    for($i = 0; $i < count($result); $i++){
                        $feedback = $service->checkResult($result, $object, $i);
                        if($feedback != NULL){
                            echo $feedback;
                            return;
                        }
                    }
                    $service->registerVacancy($object);
                    echo 'done';
                }
                
            }//5
            else
                echo '!validHourFunc';
                
            }//4
            else
                echo '!validHour';
                 
            }//3
            else
                echo '!validDate';
                
            }//2
            else
                echo '!validIdCar';
                
            }//1
            else
                echo '!validVacancy';
                
                  
        }
        else
            echo '!validObject';
             
    }
    
}

?>
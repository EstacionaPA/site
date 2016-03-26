<?php

require 'vacancies_services.php';

class VacanciesControll extends ManagerAbstract{
    public function controll($object){
        
        $service = new VacanciesServices;
        
        $validDate = $service->checkDate($object['data']);
        $validHour = $service->checkHour($object['hora_reserva'], $object['hora_fim']);
        $validIdCar = $service->checkIdCar($object['id_carro']);
        $result = NULL;
        
        if($object['vaga'] <= 8){
            if($validIdCar == 'done'){
                if($validDate == 'done'){
                    if($validHour == 'done'){
                        
                        $result = $service->requestVacancies($object);

                        if(count($result) == 0){
                            $service->registerVacancy($object);
                            echo 'done';
                        }
                        else{
                            $result = $service->checkResult($result, $object);
                            if($result != NULL)
                                echo $result;
                            
                            else{
                                $service->registerVacancy($object);
                                echo 'done';
                            }
                        }
                    }
                    else
                        echo '!validHour';
                }
                else
                    echo '!validDate';
            }
            else
                echo '!validIdCar';
        }
        else
            echo '!validVacancy';
    }
}

?>
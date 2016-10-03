<?php

class GetParks extends ManagerAbstract{
    public function controll($form){ //$form = '' ------ NÃO SERÁ UTILIZADO

        echo json_encode(SqlController::Request('RequestParks', ''));

    }
}

?>
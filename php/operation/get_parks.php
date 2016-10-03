<?php

class GetParks extends ManagerAbstract{
    public function controll($form){ //$form = '' ------ NÃO SERÁ UTILIZADO

        print_r(SqlController::Request('RequestParks', ''));

    }
}

?>
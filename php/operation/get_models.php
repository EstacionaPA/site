<?php
class GetModels {

    public function controll($markId){
        $array = SqlController::Request('RequestModels', $markId);
        echo json_encode($array);
    }
}
?>
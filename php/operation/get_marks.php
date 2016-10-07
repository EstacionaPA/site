<?php
class GetMarks {

    public function controll(){
        $resource = SqlController::Request('RequestMarks', NULL);
        echo json_encode($resource);
    }
}
?>
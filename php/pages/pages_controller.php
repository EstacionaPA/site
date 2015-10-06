<?php

class PageController {
    
 public function init() {
    $this->Controll();
 } 
 
 public function Controll() {
    header('location: ../../html/pages/main_login_a.html');
 }
}

$page = new PageController;
$page->init();
    
?>
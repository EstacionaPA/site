<?php

class Car{
    
    public $user;
    public $board;
    public $mark;
    public $model;
    
    public function __construct($idUser, $board, $mark, $model){
        $this->user = $idUser;
        $this->board = $board;
        $this->mark = $mark;
        $this->model = $model;   
    }
    
    public function getUser(){
        return $this->user;
    }
    
    public function getBoard(){
        return $this->board;
    }
    
    public function getMark(){
        return $this->mark;
    }
    
    public function getModel(){
        return $this->model;
    }
    
    public function setUser($user){
        $this->user;
    }
    public function setBoard($board){
        $this->board;
    }
    public function setMark($mark){
        $this->mark;
    }
    public function setModel($model){
        $this->model;
    }
}
?>
<?php

class Cities extends Controller{
    
    function getByID($id){
        $this->loadModel('Cities');
        return $this->Cities->getByID($id);
    }
    
    function getByName($name){
        $this->loadModel('Cities');
        return $this->Cities->getByName($name);
    }
    
    function getByZip($zip){
        $this->loadModel('Cities');
        return $this->Cities->getByZip($zip);
    }
}
?>

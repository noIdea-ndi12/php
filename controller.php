<?php
class Controller{
    
    public function loadModel($name){
        $nameComp = PRE_MODEL . $name;
        $file = LOC_MODEL . $nameComp . '.php';
        require_once $file;
        if(!isset($this->$name))
            $this->$name = new $nameComp();
    }
    
    public function request($controller,$action,$param = null){
        $controller = $controller;
        require_once LOC_CONTROLLER . $controller . '.php';
        $controller = new $controller;
        return call_user_func_array(array($controller, $action),$param);
    }
    
    public function redirect($url,$code = null){
        $this->rendered = true;
        if($code == 301){
            Header("HTTP/1.1 301 Moved Permanently");
        }
        Header("Location: " . Router::url($url));
    }
}
?>

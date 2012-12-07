<?php
class Street extends Controller{
    
    function get($id){
        echo $id;
        $this->request('location', 'get',array($id));
    }
}
?>

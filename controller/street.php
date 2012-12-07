<?php
class Street extends Controller{
    
    function get($id){
        $this->loadModel('Street');
        $data = $this->Street->get($id);
        
        $data['ville'] = $this->request('cities', 'getByID', array($data['cities_id']));
        
        echo json_encode($data);
    }
    
    function search($page = 0){
        extract($_POST);
        
        $this->loadModel('Street');
        $data = $this->Street->search($rue,$ville,$page);
    }
    
    function delete($id){
        $this->loadModel('Street');
        $this->Street->delete($id);
    }
    
    function set($id = null){
        $this->loadModel('Street');
        $this->Street->set($id);
    }
}
?>

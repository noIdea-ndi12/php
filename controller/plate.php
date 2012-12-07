<?php
class Plate extends Controller{ 
    
    function get(){
        $rep = "KO";
        $id = $_REQUEST['id'];
        $like = $_REQUEST['like'];
        
        $this->loadModel('Plate');
        
        if($_REQUEST['like']) $rep = $this->Plate->fonctionModel($params);
        else if($_REQUEST['id']) $rep = $this->Plate->fonctionModel($param[0]); // Param[0] = id

        $rep = json_encode($rep);
        // print_r($rep);
        return $rep;
    }
    
    
}
?>

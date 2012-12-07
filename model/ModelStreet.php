<?php

class ModelStreet{
    
    function get($id){
        if(!numeric($id))
            return false;
        
        $sql = "SELECT * FROM streets WHERE id = " . $id;
        $result = mysql_query($sql) or exit(false);
        return mysql_fetch_assoc($result);
    }
    
    function search($street, $city  , $page){
        $sql = "SELECT * FROM streets,cities WHERE streets.name LIKE '" . $street . "%' AND cities.name = '" . $city . "' LIMIT " . $page*ITEM_PER_PAGE . ',' . ITEM_PER_PAGE;
        
        $result = mysql_query($sql) or exit(false);

        $data = array();
        while($donnee = mysql_fetch_assoc($result)){
            $data[] = $donnee;
        }
        return $data;
    }
    
    function delete($id){
        if(!is_numeric($id))
            return false;
        
        $sql = "DELETE FROM streets WHERE id =" . $id;
        return mysql_query($sql);
    }
    
    function set($id = null){
        if(id == null){
            $sql = "INSERT INTO streets ";
            
            $param = '(';
            $values = '(';
            
            foreach($_POST as $k => $v){
                $param .= "$k,";
                if(!is_numeric($v))
                    $values .= "'$v'";
                else {
                    $values .= "$v";
                }
            }
            
            $values = substr($values,0,-1);
            $param = substr($param,0,-1);
            
            $values .= ')';
            $param .= ')';
            
            $sql .= $param . " VALUES " . $values; 
            return mysql_query($sql);
        }
        else{
            if(!numeric($id))
                return false;
            
            $sql = "UPDATE streets SET ";
            
            foreach($_POST as $k => $v){
                if(!is_numeric($v))
                    $sql .= "$k='$v'";
                else {
                    $sql .= "$k=$v";
                }
            }
            
            $sql .= "WHERE id = " . $id;
            
            return mysql_query($sql);
        }
    }
}

?>

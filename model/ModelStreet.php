<?php

class ModelStreet{
    
    function get($id){
        if(!numeric($id))
            return false;
        
        $sql = "SELECT * FROM streets WHERE id = " . $id;
        return mysql_fetch_array(mysql_query($sql));
    }
    
    //TODO : changer le * par cqu'on a besoin.
    //TODO : a revoir.
    function search($street,$city,$page = 0){
        $sql = "SELECT * FROM streets, cities WHERE streets.name LIKE " . htmlspecialchars($street) . "AND cities.name = '" . htmlspecialchars($city) . "' LIMIT " . $page*ITEM_PER_PAGE . "," . ITEM_PER_PAGE;
        return mysql_fetch_array(mysql_query($sql));
    }
    
    function delete($id){
        if(!numeric($id))
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

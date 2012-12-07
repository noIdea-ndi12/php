<?php
class ModelCities{
       
    function getByID($id){
        $sql = "SELECT * FROM cities WHERE id = " . $id;
        $result = mysql_query($sql);
        return mysql_fetch_assoc($result);
    }
    
    function getByName($name){
        $sql = "SELECT * FROM cities WHERE name = " . $id;
        $result = mysql_query($sql);
        return mysql_fetch_assoc($result);
    }
    
    function getByZip($zip){
        $sql = "SELECT * FROM cities WHERE zip_code = " . $id;
        $result = mysql_query($sql);
        return mysql_fetch_assoc($result);
    }
}
?>

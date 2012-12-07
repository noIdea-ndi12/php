<?php
class ModelCities{
       
    function getByID($id){
        $sql = "SELECT * FROM cities WHERE id = " . $id;
        return mysql_fetch_array(mysql_query($sql));
    }
    
    function getByName($name){
        $sql = "SELECT * FROM cities WHERE name = " . $id;
        return mysql_fetch_array(mysql_query($sql));
    }
    
    function getByZip($zip){
        $sql = "SELECT * FROM cities WHERE zip_code = " . $id;
        return mysql_fetch_array(mysql_query($sql));
    }
}
?>

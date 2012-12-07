Class Street{
	
}

Class ModelPlate {
        $_nomTable = "Plate";
        
	function delete($id){
            $query_test_exist = sprintf("
            SELECT * FROM plate
                     WHERE firstname='%s' AND lastname='%s'",
                mysql_real_escape_string($firstname),
                mysql_real_escape_string($lastname));
    
            $query_delete = 

            // Exécution de la requête
            $result = _query($query);
	}
	
	function set($param1, $param2){
		// R�ponse du model.
		
		$rep = ; 
		if($param1 == "like"){
				
		}
		else{
			/* $param1 n'est pas de type /like, donc c'est une image
			par d�finition */
			if($param2) $img_to_upload = base64_encode($param2);
			else $rep = "KO";
		}		
	}

	funtion _query($str){
            return mysql_query($str);
        }
}
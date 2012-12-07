<?php
Class ModelPlate {
        $_nomTable = "plate";
        
	function delete($id){
            // TODO : Filtrer l'id ? injection sql ?
            
            // On récupère l'objet de la plaque et :
            // - les StreetsPictures qui la concerne
            $this->loadModel('StreetPictures');        
            if() $rep = $this->StreetPictures->fonctionModel($params);
        
            // DELETE dans StreetPlatePictures
            $query_delete = "DELETE FROM plate WHERE plate.id='$id'";
             
            
            // DELETE 
            // Exécution de la requête
            if(!_query($query_delete)) return "KO";
            else return "OK";
	}
	
	function set($param1, $param2){
		// R�ponse du model.		
		$rep = $param; 
		if($param1 == "like"){
                    
		}
		else{
                    /* $param1 n'est pas de type /like, donc c'est une image
                    par d�finition */
                    if($param2) $img_to_upload = base64_encode($param2);
                    else $rep = "KO";
		}		
	}
        
        function get($id){
            $rep;
            $query_select =
            "
                SELECT * 
                FROM 
                    pictures as pic,
                    streets_plates_pictures as plate                  
                WHERE 
                    pic.id = plate.pictures_id 
                    AND plate.streets_id = '$id'                    
            ";
            $result = _query($query_delete);
            $plaque_de_rue = array();
            
            while($row = mysql_fetch_array($result){
                $plaque_de_rue[] = ;
            }
        }
        
	function _query($str){
            return mysql_query($str);
        }
}
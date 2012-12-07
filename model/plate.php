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
	
	function set($params){
		// R�ponse du model.		
		$rep = "OK"; 
                
		if($params[0] == "like"){
                    
		}
		else{
                    /* $param1 n'est pas de type /like, donc c'est une image
                    par d�finition */
                    if($param2){
                        $img_to_upload = base64_encode($param2);
                        
                        // Upload de l'image 
                        $query_insert_in_pictures = "
                            INSERT INTO pictures VALUES (null, $img_to_upload)
                        ";
                        if(!_query($query_insert_in_pictures)) $rep = "KO";
                        
                        // Je créer le lien image-de-plaque à rue
                        $query_insert_in_pictures = "
                            INSERT INTO streets_plates_pictures VALUES (".$params[0].", ".$params[].")
                        ";
                        if(!_query($query_insert_in_pictures)) $rep = "KO";
                    }
		}
                return $rep;
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
            
            $compteur = 0;
            while($row = mysql_fetch_array($result){
                $plaque_de_rue[$compteur]['streets_plates_id'] = ;
                $compteur++;
            }
        }
        
	function _query($str){
            return mysql_query($str);
        }
}
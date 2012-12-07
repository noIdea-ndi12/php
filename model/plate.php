<?php
Class ModelPlate {        
	function delete($picture_id){
            // TODO : Filtrer l'id ? injection sql ?
            $rep = "OK";
            
            // DELETE dans StreetPlatePictures
            $query_delete = "DELETE FROM streets_plates_pictures as plate WHERE plate.pictures_id='$picture_id'";
            if(!_query($query_delete)) return "KO";
            
            // DELETE dans StreetPlatePictures
            $query_delete = "DELETE FROM pictures as plate WHERE pictures.id='$picture_id'";
            if(!_query($query_delete)) return "KO";
            
            else return "OK";
	}
	
	function set($params){
		// R�ponse du model.		
		$rep = "OK"; 
               
                /* $param1 n'est pas de type /like, donc c'est une image
                par d�finition */
                $img_to_upload = base64_encode($param2);

                // Upload de l'image 
                $query_insert_in_pictures = "
                    INSERT INTO pictures VALUES (null, $img_to_upload)
                ";
                if(!_query($query_insert_in_pictures)) $rep = "KO";

                $query_select = "SELECT * FROM pictures ORDER BY id DESC";
                if(!$row = mysql_fetch_row(_query($query_insert_in_pictures))) $rep = "KO";

                // Je créer le lien image-de-plaque à rue
                $query_insert_in_pictures = "
                    INSERT INTO streets_plates_pictures VALUES (".$params[0].", ".$row["id"].", null)
                ";

                if(!_query($query_insert_in_pictures)) $rep = "KO";
                
                return $rep;
	}
        
	function _query($str){
            return mysql_query($str);
        }
}
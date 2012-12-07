<?php
class ModelLocation{
	
	public function get($args){
		$select = 'SELECT * FROM locations';
		$where = ' WHERE (1=1) ';
		$locations_by_city = array();
		
		if(is_int($args) && $args>0){
			$where.= ' id = '.$args;
		}
		else if(is_array($args)){
			if(array_key_exists('name', $args))
				$where.= ' AND name = '."'".$args['name']."'";
			if(array_key_exists('city', $args))
				$locations_by_city = $this->getLocationsByCity($args['city']);
		}
		else
			return array();
		
		$res = mysql_query($select.$where);
		$locations_by_name = array();
		while($row = mysql_fetch_array($res)){
			$locations_by_name[$row['id']] = $row;
		}
		$results = array_merge($locations_by_city, $locations_by_name);
		$locations = array();
		foreach($results as $location){
			$location['pictures'] = $this->getPictures($row['id']);
			$locations[] = array(
						'id' => $location['id'],
						'name' => $location['name'],
						'content' => $location['content'],
						'pictures' => $this->getPictures($location['id']),
						);
		}
		return $locations;
	}

	private function getLocationsByCity($city_name){
		$select = 'SELECT locations.id, locations.name, locations.content FROM cities';
		$join = ' JOIN streets ON cities.id=streets.cities_id';
		$join.= ' JOIN locationsstreet ON  locationsstreet.id_street=streets.id';
		$join.= ' JOIN locations ON  locations.id=locationsstreet.id_location';
		$where = ' WHERE cities.name ='.$city_name;
		
		$res = mysql_query($select.$join.$where);
		if(!$res)
			return array();
		
		$locations = array();
		while($row = mysql_fetch_array($res)){
			$locations[$row['locations.id']] = $row;
		}
		return $locations;
	}
	
	private function getPictures($location_id){
		$select = 'SELECT * FROM pictures';
		$join = ' JOIN pictures_locations ON  pictures_locations.pictures_id=pictures.id';
		$where = ' WHERE pictures_locations.locations_id ='.$location_id;
		
		$result = mysql_query($select.$join.$where);
		if(!$result)
			return array();
		
		$pictures = array();
		while($row = mysql_fetch_array($result)){
			$pictures[] = array(
							'id' => $row['pictures.id'],
							'url' => $row['pictures.url'],
							'location_id' => $location_id,
							);
		}
		
		return $pictures;
	}
	
	public function create($args){
		if(!array_key_exists('id_streets', $args) || !array_key_exists('name', $args) || !array_key_exists('content', $args))
			return false;
		
		$insert = 'INSERT INTO locations';
		$attributes = ' (name, content)';
		$values = ' VALUES('."'".$args['name']."','".$args['content']."'".')';
		mysql_query($insert.$attributes.$values);
		$location_id = mysqk_insert_id();
		if($location_id<=0)
			return false;
		
		// $insert = 'INSERT INTO locationsstreet';
		// $attributes = ' (id_street, location_id)';
		// $values = '';
		// foreach($args['id_streets'] as $street_id)
			// $values.= ' VALUES('.$street_id.','.$location_id.')';
		$this->assocLocationsStreet($location_id, $args['id_streets']);
		mysql_query($insert.$attributes.$values);
		return true;
	}
	
	private function assocLocationsStreet($location_id, $id_streets){
		$insert = 'INSERT INTO locationsstreet';
		$attributes = ' (id_street, location_id)';
		$values = '';
		foreach($id_streets as $street_id)
			$values.= ' VALUES('.$street_id.','.$location_id.')';
		
		mysql_query($insert.$attributes.$values);
	}
	
	public function update($location_id, $args){
		$update = 'UPDATE locations';
		// $set = ' SET';
		// if(array_key_exists('id_streets', $args))
			// $set.= ' '$args['id_streets'];
		$set = array();
		if(array_key_exists('name', $args))
			$set[] = 'name = '."'".$args['name']."'";
		if(array_key_exists('content', $args))
			$set[] = 'content = '."'".$args['content']."'";
		$set = ' SET '.implode(',', $set);
		$where = ' WHERE id='.$location_id;
		
		mysql_query($update.$set.$where);
		
		$delete = 'DELETE FROM locationsstreet';
		$where = ' WHERE location_id = '.$location_id;
		mysql_query($delete.$where);
		
		return (mysql_affected_rows()>0);
	}
	
	public function delete($location_id){
		if(!is_numeric($id))
			return;
		$photos = $this->getPictures($location_id);
		$photos_ids = array();
		foreach($photos as $photo):
			$photos_ids[] = $photo['id'];
		endforeach;
		
		//suppression des photos lié à la locations
		$delete = 'DELETE FROM  pictures';
		$where = ' WHERE id IN('.implode(',', $photos_ids).')';
		mysql_query($delete.$where);
		
		$delete = 'DELETE FROM  pictures_locations';
		$where = ' WHERE locations_id = '.$location_id;
		mysql_query($delete.$where);
		
		$delete = 'DELETE FROM locationsstreet';
		$where = ' WHERE location_id = '.$location_id;
		mysql_query($delete.$where);
		
		$delete = 'DELETE FROM locations';
		$where = ' WHERE id = '.$location_id;
		mysql_query($delete.$where);
	}
}
?>
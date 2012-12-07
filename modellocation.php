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
		while($row = mysql_fetch_array($res)){
			$locations_by_name[$row['id']] = $row;
		}
		$results = array_merge($locations_by_city, $locations_by_name);
		$locations = array();
		foreach($results as $location){
			$location['pictures'] = $this->getPictures($row['id']);
			$locations[] = $location;
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
			$pictures[] = $row;
		}
		
		return $pictures;
	}
}
?>
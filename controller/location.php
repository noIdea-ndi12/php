<?php

class Location{

	public function __construct(){
		//load
	}

	public function get($id){
		$res = $this->location->get($id);
		$location = array(
				'id' => $location['id'],
				'name' => $location['name'],
				'content' => $location['content'],
				'pictures' => $location['pictures'],
				);
		return json_encode($location);
	}
	
	public function search($page = 0){
		if(!array_key_exists('name', $_POST) && !array_key_exists('city', $_POST))
			exit('erreur => envoyer en POST information name ou/et city');
			
		$args = array();
		if(array_key_exists('name', $_POST) && !empty($_POST['name']))
			$args['name'] = $_POST['name'];
		if(array_key_exists('city', $_POST) && !empty($_POST['city']))
			$args['city'] = $_POST['city'];
		$res = $this->location->get($args['city']);
	}
	
	public function delete($id){
	
	}
	
	public function set($id = 0){
	
	}

	//public function photo
}

?>
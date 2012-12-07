<?php

class Location{

	public function __construct(){
		//load
	}

	public function get($id){
		$location = $this->location->get($id);
		return json_encode($location[0]);
	}
	
	public function search($page = 0){
		if(!array_key_exists('name', $_POST) && !array_key_exists('city', $_POST))
			exit('erreur => envoyer en POST information name ou/et city');
			
		$args = array();
		if(array_key_exists('name', $_POST) && !empty($_POST['name']))
			$args['name'] = $_POST['name'];
		if(array_key_exists('city', $_POST) && !empty($_POST['city']))
			$args['city'] = $_POST['city'];
		$res = $this->location->get($args);
		
		///////////////pagination
		return json_encode($res);
	}
	
	public function delete($id){
		$this->location->delete($id);
	}
	
	public function set($id = 0){
		if(!array_key_exists('id_streets', $_POST) && !array_key_exists('name', $_POST) && !array_key_exists('content', $_POST))
			exit('erreur => envoyer en POST information id_streets(array), name, content');
		
		$args = array();
		if(array_key_exists('id_streets', $_POST) && !empty($_POST['id_streets']))
			$args['id_streets'] = $_POST['id_streets'];
		if(array_key_exists('name', $_POST) && !empty($_POST['name']))
			$args['name'] = $_POST['name'];
		if(array_key_exists('content', $_POST) && !empty($_POST['content']))
			$args['content'] = $_POST['content'];
		$res = $this->location->get($args);

		if($id==0)
			$this->location->create($args);
		else
			$this->location->update($id, $args);
	}

	//public function photo
}

?>
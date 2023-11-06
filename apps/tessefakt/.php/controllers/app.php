<?php
namespace tessefakt\apps\tessefakt\controllers;
class app extends \tessefakt\controller{
	public function create(array $data):int{
		return $this->_create(
			$data['key'],
			$data['name'],
			$data['major'],
			$data['minor'],
			$data['build'],
			$data['caption']
		);
	}
	protected function _create(string $key,string $name,string $major,string $minor,string $build,string $caption):int{
		$this->db->current->query('
			insert into `_apps`
			set 
				`key`="'.$this->db->current->escape($key).'",
				`name`="'.$this->db->current->escape($name).'",
				`major`="'.$this->db->current->escape($major).'",
				`minor`="'.$this->db->current->escape($minor).'",
				`build`="'.$this->db->current->escape($build).'",
				`caption`="'.$this->db->current->escape($caption).'"
		');
		$iId=$this->db->current->insert();
		return $iId;
	}
}
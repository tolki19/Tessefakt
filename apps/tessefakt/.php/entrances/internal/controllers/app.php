<?php
namespace tessefakt\apps\tessefakt\entrances\internal\controllers;
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
		$this->connectors->db->query('
			insert into `_apps`
			set 
				`key`="'.$this->connectors->db->escape($key).'",
				`name`="'.$this->connectors->db->escape($name).'",
				`major`="'.$this->connectors->db->escape($major).'",
				`minor`="'.$this->connectors->db->escape($minor).'",
				`build`="'.$this->connectors->db->escape($build).'",
				`caption`="'.$this->connectors->db->escape($caption).'"
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
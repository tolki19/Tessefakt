<?php
namespace tessefakt\apps\tessefakt\controllers;
class group extends \tessefakt\controller{
	public function create(array $data):int{
		return $this->_create(
			$data['name']
		);
	}
	protected function _create(string $name):int{
		$this->connectors->db->query('
			insert into `_groups`
			set 
				`name`="'.$this->connectors->db->escape($name).'"
		');
		return $this->connectors->db->insert();
	}
}
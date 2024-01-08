<?php
namespace tessefakt\apps\tessefakt\libraries;
class groups extends \tessefakt\library{
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
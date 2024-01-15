<?php
namespace tessefakt\apps\tessefakt\libraries;
class groups extends \tessefakt\library{
	public function create(
		string $name
	):int{
		return $this->_create(
			name:$name
		);
	}
	protected function _create(
		string $name
	):int{
		$this->connectors->db->query('
			insert into `_groups`
			set 
				`name`="'.$this->connectors->db->escape($name).'"
		');
		return $this->connectors->db->insert();
	}
	public function update(
		int $id,
		string $name
	):int{
		return $this->_update(
			id:$id,
			name:$name
		);
	}
	protected function _update(
		int $id,
		string $name
	):int{
		$this->connectors->db->query('
			update `_groups`
			set 
				`name`="'.$this->connectors->db->escape($name).'"
			where `id`='.$id.'
		');
		return $this->connectors->db->insert();
	}
}
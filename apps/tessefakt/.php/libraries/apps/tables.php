<?php
namespace tessefakt\apps\tessefakt\libraries\apps;
class tables extends \tessefakt\library{
	public function create(
		int $app,
		string $table,
		string $version,
		string $state="active",
	):int{
		return $this->_create(
			app:$app,
			table:$table,
			state:$state,
			version:$version
		);
	}
	protected function _create(
		int $app,
		string $table,
		string $version,
		string $state,
	):int{
		$this->connectors->db->query('
			insert into `_app-tables`
			set
				`_app`='.$app.',
				`table`="'.$this->connectors->db->escape($table).'",
				`state`="'.$this->connectors->db->escape($state).'",
				`version`="'.$this->connectors->db->escape($version).'"
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
	public function update(
		int $id,
		int $app,
		string $table,
		string $version,
		string $state="active",
	):int{
		return $this->_update(
			id:$id,
			app:$app,
			table:$table,
			state:$state,
			version:$version
		);
	}
	protected function _update(
		int $id,
		int $app,
		string $table,
		string $version,
		string $state,
	):int{
		$this->connectors->db->query('
			update `_app-tables`
			set
				`_app`='.$app.',
				`table`="'.$this->connectors->db->escape($table).'",
				`state`="'.$this->connectors->db->escape($state).'",
				`version`="'.$this->connectors->db->escape($version).'"
			where `id`='.$id.'
		');
		return $id;
	}
	public function delete(
		int $id,
	):int{
		return $this->_delete(
			id:$id,
		);
	}
	protected function _delete(
		int $id,
	):int{
		$this->connectors->db->query('
			delete `_app-tables`
			where `id`='.$id.'
		');
		return $id;
	}
}
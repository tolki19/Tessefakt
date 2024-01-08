<?php
namespace tessefakt\apps\tessefakt\libraries\app;
class tables extends \tessefakt\library{
	public function create(int $app,array $data):int{
		return $this->_create(
			$app,
			$data['table'],
			'active',
			1
		);
	}
	protected function _create(int $app,string $table,string $state,int $version):int{
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
}
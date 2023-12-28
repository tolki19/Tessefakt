<?php
namespace tessefakt\apps\tessefakt\libraries\app;
class db_right extends \tessefakt\library{
	public function create(int $app,array $data):int{
		return $this->_create(
			$app,
			$data['table'],
			$data['set'],
			$data['field'],
			$data['right']
		);
	}
	protected function _create(int $app,string $table,string|int|null $set,?string $field,string|int $right):int{
		$this->connectors->db->query('
			insert into `_app-db-rights`
			set
				`_app`='.$app.',
				`table`="'.$this->connectors->db->escape($table).'",
				`set`='.(is_null($set)?'null':'"'.$this->connectors->db->escape($set).'"').',
				`field`='.(is_null($field)?'null':'"'.$this->connectors->db->escape($field).'"').',
				`right`="'.$this->connectors->db->escape($right).'"
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
<?php
namespace tessefakt\apps\tessefakt\controllers;
class app_db_right extends \tessefakt\controller{
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
		$this->db->current->query('
			insert into `_app-db-rights`
			set
				`_app`='.$app.',
				`table`="'.$this->db->current->escape($table).'",
				`set`='.(is_null($set)?'null':'"'.$this->db->current->escape($set).'"').',
				`field`='.(is_null($field)?'null':'"'.$this->db->current->escape($field).'"').',
				`right`="'.$this->db->current->escape($right).'"
		');
		$iId=$this->db->current->insert();
		return $iId;
	}
}
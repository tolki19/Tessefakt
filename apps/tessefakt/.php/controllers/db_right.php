<?php
namespace tessefakt\apps\tessefakt\controllers;
class db_rights extends \tessefakt\controller{
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
				`table`="'.$table.'",
				`set`='.(is_null($set)?'null':'"'.$set.'"').',
				`field`='.(is_null($field)?'null':'"'.$field.'"').',
				`right`="'.$right.'"
		');
		$iId=$this->db->current->insert();
		return $iId;
	}
}
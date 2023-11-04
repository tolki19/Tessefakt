<?php
namespace tessefakt\apps\tessefakt\controllers;
class db_rights extends \tessefakt\controller{
	public function create_db_rights(int $app,array $data):array{
		return $this->_create_appDbRights($app,$data);
	}
	protected function _create_appDbRights(int $app,array $rights):array{
		$aReturn=[];
		foreach($rights as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appDbRight(
				$app,
				$aRight['table'],
				$aRight['set'],
				$aRight['field'],
				$aRight['right']
			);
		return $aReturn;
	}
	protected function _create_appDbRight(int $app,string $table,string|int|null $set,?string $field,string|int $right):int{
		$this->dbs->current->query('
			insert into `_app-db-rights`
			set
				`_app`='.$app.',
				`table`="'.$table.'",
				`set`='.(is_null($set)?'null':'"'.$set.'"').',
				`field`='.(is_null($field)?'null':'"'.$field.'"').',
				`right`="'.$right.'"
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
}
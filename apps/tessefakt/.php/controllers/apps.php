<?php
namespace tessefakt\apps\tessefakt\controllers;
class apps extends \tessefakt\controller{
	public function create(array $data):int{
		$iApp=$this->_create_app(
			$data['key'],
			$data['name'],
			$data['major'],
			$data['minor'],
			$data['build'],
			$data['caption']
		);
		$iAppControllerMethodRights=$this->_create_appControllerMethodRights($iApp,$data['appControllerMethodRights']??[]);
		$iAppDbRights=$this->_create_appDbRights($iApp,$data['appDbRights']??[]);
		$iAppTplRights=$this->_create_appTplRights($iApp,$data['appTplRights']??[]);
		return $iApp;
	}
	protected function _create_app(string $key,string $name,string $major,string $minor,string $build,string $caption):int{
		$this->dbs->current->query('
			insert into `_apps`
			set 
				`key`="'.$this->dbs->current->escape($key).'",
				`name`="'.$this->dbs->current->escape($name).'",
				`major`="'.$this->dbs->current->escape($major).'",
				`minor`="'.$this->dbs->current->escape($minor).'",
				`build`="'.$this->dbs->current->escape($build).'",
				`caption`="'.$this->dbs->current->escape($caption).'"
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
	protected function _create_appTables(int $app,array $tables):array{
		$aReturn=[];
		foreach($tables as $sTable) $aReturn[$sTable]=$this->_create_appTable(
				$app,
				$sTable,
				'active',
				1
			);
		return $aReturn;
	}
	protected function _create_appTable(int $app,array $table,string $state,int $version):array{
		$this->dbs->current->query('
			insert into `_app-tables`
			set
				`_app`='.$app.',
				`table`="'.$this->dbs->current->escape($table).'",
				`state`="'.$this->dbs->current->escape($state).'",
				`version`="'.$this->dbs->current->escape($version).'"
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
	protected function _create_appControllerMethodRights(int $app,array $rights):array{
		$aReturn=[];
		foreach($rights as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appControllerMethodRight(
				$app,
				$aRight['controller'],
				$aRight['method'],
				$aRight['right']
			);
		return $aReturn;
	}
	protected function _create_appControllerMethodRight(int $app,string $controller,?string $method,string|int $right):int{
		$this->dbs->current->query('
			insert into `_app-controller-method-rights`
			set
				`_app`='.$app.',
				`controller`="'.$controller.'",
				`method`='.(is_null($method)?'null':'"'.$method.'"').',
				`right`="'.$right.'"
		');
		$iId=$this->dbs->current->insert();
		return $iId;
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
	protected function _create_appTplRights(int $app,array $rights):array{
		$aReturn=[];
		foreach($rights as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appTplRight(
				$app,
				$aRight['table'],
				$aRight['div'],
				$aRight['right']
			);
		return $aReturn;
	}
	protected function _create_appTplRight(int $app,string $tpl,?string $div,string|int $right):int{
		$this->dbs->current->query('
			insert into `_app-tpl-rights`
			set
				`_app`='.$app.',
				`tpl`="'.$tpl.'",
				`div`='.(is_null($div)?'null':'"'.$div.'"').',
				`right`="'.$right.'"
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
}
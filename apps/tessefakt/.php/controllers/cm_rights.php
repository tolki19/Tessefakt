<?php
namespace tessefakt\apps\tessefakt\controllers;
class cm_rights extends \tessefakt\controller{
	public function create_cm_rights(int $app,array $data):array{
		return $this->_create_appCMRights($app,$data);
	}
	protected function _create_appCMRights(int $app,array $rights):array{
		$aReturn=[];
		foreach($rights as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appCMRight(
				$app,
				$aRight['controller'],
				$aRight['method'],
				$aRight['right']
			);
		return $aReturn;
	}
	protected function _create_appCMRight(int $app,string $controller,?string $method,string|int $right):int{
		$this->dbs->current->query('
			insert into `_app-cm-rights`
			set
				`_app`='.$app.',
				`controller`="'.$controller.'",
				`method`='.(is_null($method)?'null':'"'.$method.'"').',
				`right`="'.$right.'"
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
}
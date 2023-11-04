<?php
namespace tessefakt\apps\tessefakt\controllers;
class tpl_rights extends \tessefakt\controller{
	public function create_tpl_rights(int $app,array $data):array{
		return $this->_create_appTplRights($app,$data);
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
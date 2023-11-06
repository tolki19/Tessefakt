<?php
namespace tessefakt\apps\tessefakt\controllers;
class tpl_right extends \tessefakt\controller{
	public function create(int $app,array $data):int{
		return $this->_create_appTplRight(
				$app,
				$aRight['table'],
				$aRight['div'],
				$aRight['right']
			);
	}
	protected function _create(int $app,string $tpl,?string $div,string|int $right):int{
		$this->db->current->query('
			insert into `_app-tpl-rights`
			set
				`_app`='.$app.',
				`tpl`="'.$tpl.'",
				`div`='.(is_null($div)?'null':'"'.$div.'"').',
				`right`="'.$right.'"
		');
		$iId=$this->db->current->insert();
		return $iId;
	}
}
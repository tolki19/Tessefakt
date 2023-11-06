<?php
namespace tessefakt\apps\tessefakt\controllers;
class cm_right extends \tessefakt\controller{
	public function create(int $app,array $data):int{
		return $this->_create(
			$app,
			$data['controller'],
			$data['method'],
			$data['right']
		);
	}
	protected function _create(int $app,string $controller,?string $method,string|int $right):int{
		$this->db->current->query('
			insert into `_app-cm-rights`
			set
				`_app`='.$app.',
				`controller`="'.$controller.'",
				`method`='.(is_null($method)?'null':'"'.$method.'"').',
				`right`="'.$right.'"
		');
		$iId=$this->db->current->insert();
		return $iId;
	}
}
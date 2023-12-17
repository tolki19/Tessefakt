<?php
namespace tessefakt\apps\tessefakt\controllers;
class app_cm_right extends \tessefakt\controller{
	public function create(int $app,array $data):int{
		return $this->_create(
			$app,
			$data['controller'],
			$data['method'],
			$data['right']
		);
	}
	protected function _create(int $app,string $controller,?string $method,string|int $right):int{
		$this->connectors->db->query('
			insert into `_app-cm-rights`
			set
				`_app`='.$app.',
				`controller`="'.$this->connectors->db->escape($controller).'",
				`method`='.(is_null($method)?'null':'"'.$this->connectors->db->escape($method).'"').',
				`right`="'.$this->connectors->db->escape($right).'"
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
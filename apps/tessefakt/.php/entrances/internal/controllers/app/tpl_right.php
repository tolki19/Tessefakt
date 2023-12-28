<?php
namespace tessefakt\apps\tessefakt\entrances\internal\controllers;
class tpl_right extends \tessefakt\controller{
	public function create(int $app,array $data):int{
		return $this->_create(
			$app,
			$data['tpl'],
			$data['div']
		);
	}
	protected function _create(int $app,string $tpl,?string $div,string|int $right):int{
		$this->connectors->db->query('
			insert into `_app-tpl-rights`
			set
				`_app`='.$app.',
				`tpl`="'.$this->connectors->db->escape($table).'",
				`div`='.(is_null($div)?'null':'"'.$this->connectors->db->escape($div).'"').',
				`right`="'.$right.'"
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
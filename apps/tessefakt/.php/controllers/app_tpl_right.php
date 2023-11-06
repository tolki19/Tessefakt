<?php
namespace tessefakt\apps\tessefakt\controllers;
class app_tpl_right extends \tessefakt\controller{
	public function create(int $app,array $data):int{
		return $this->_create(
			$app,
			$data['tpl'],
			$data['div']
		);
	}
	protected function _create(int $app,string $tpl,?string $div,string|int $right):int{
		$this->db->current->query('
			insert into `_app-tpl-rights`
			set
				`_app`='.$app.',
				`tpl`="'.$this->db->current->escape($table).'",
				`div`='.(is_null($div)?'null':'"'.$this->db->current->escape($div).'"').',
				`right`="'.$right.'"
		');
		$iId=$this->db->current->insert();
		return $iId;
	}
}
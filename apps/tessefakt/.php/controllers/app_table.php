<?php
namespace tessefakt\apps\tessefakt\controllers;
class app_table extends \tessefakt\controller{
	public function create(int $app,array $data):int{
		return $this->_create(
			$app,
			$data['table'],
			'active',
			1
		);
	}
	protected function _create(int $app,string $table,string $state,int $version):int{
		$this->db->current->query('
			insert into `_app-tables`
			set
				`_app`='.$app.',
				`table`="'.$this->db->current->escape($table).'",
				`state`="'.$this->db->current->escape($state).'",
				`version`="'.$this->db->current->escape($version).'"
		');
		$iId=$this->db->current->insert();
		return $iId;
	}
}
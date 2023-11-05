<?php
namespace tessefakt\apps\tessefakt\controllers;
class app_tables extends \tessefakt\controller{
	public function create_tables(int $app,array $data):array{
		return $this->_create_appTables($app,$data);
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
	protected function _create_appTable(int $app,string $table,string $state,int $version):int{
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
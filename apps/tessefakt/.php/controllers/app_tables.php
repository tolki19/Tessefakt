<?php
namespace tessefakt\apps\tessefakt\controllers;
class app_tables extends \tessefakt\controller{
	public function create_tables(int $app,array $data):array{
		return $this->_create_appTables($iApp,data['tables']);
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
}
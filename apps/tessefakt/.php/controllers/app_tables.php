<?php
namespace tessefakt\apps\tessefakt\controllers;
class app_tables extends \tessefakt\controller{
	public function create(int $app,array $data):array{
		$aReturn=[];
		foreach($data as $aTable) $aReturn[]=$this->app->app_table->create($app,$aTable);
		return $aReturn;
	}
}
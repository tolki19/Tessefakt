<?php
namespace tessefakt\apps\tessefakt\controllers;
class app_db_rights extends \tessefakt\controller{
	public function create(int $app,array $data):array{
		$aReturn=[];
		foreach($data as $aRight) $aReturn[]=$this->app->db_right->create($app,data);
		return $aReturn;
	}
}
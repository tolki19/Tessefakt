<?php
namespace tessefakt\apps\tessefakt\controllers;
class app_tpl_rights extends \tessefakt\controller{
	public function create(int $app,array $data):array{
		$aReturn=[];
		foreach($data as $aRight) $aReturn[]=$this->app->tpl_right->create($app,$aRight);
		return $aReturn;
	}
}
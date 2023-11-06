<?php
namespace tessefakt\apps\tessefakt\controllers;
class cm_rights extends \tessefakt\controller{
	public function create(int $app,array $data):array{
		$aReturn=[];
		foreach($data as $aRight) $aReturn[]=$this->app->cm_right->create($app,$aRight);
		return $aReturn;
	}
}
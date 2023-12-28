<?php
namespace tessefakt\apps\tessefakt\controllers;
class apps extends \tessefakt\library{
	public function create(array $data):array{
		$aReturn=[];
		foreach($data as $aApp) $aReturn[]=$this->app->apps->create($aApp);
		return $aReturn;
	}
}
<?php
namespace tessefakt\apps\tessefakt\controllers;
class settings extends \tessefakt\controller{
	public function create(array $data):int{
		$aReturn=[];
		foreach($data as $aSetting) $aReturn[]=$this->app->setting->create($aSetting);
		return $aReturn;
	}
}
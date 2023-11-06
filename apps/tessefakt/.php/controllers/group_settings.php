<?php
namespace tessefakt\apps\tessefakt\controllers;
class group_settings extends \tessefakt\controller{
	public function create(int $group,int $setting,array $data):int{
		$aReturn=[];
		foreach($data as $aSetting) $aReturn[]=$this->app->group_setting->create($group,$setting,$aSetting);
		return $aReturn;
	}
}
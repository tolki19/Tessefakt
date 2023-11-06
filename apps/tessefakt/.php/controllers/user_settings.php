<?php
namespace tessefakt\apps\tessefakt\controllers;
class user_settings extends \tessefakt\controller{
	public function create(int $user,int $setting,array $data):int{
		$aReturn=[];
		foreach($data as $aSetting) $aReturn[]=$this->app->user_setting->create($user,$setting,$aSetting);
		return $aReturn;
	}
}
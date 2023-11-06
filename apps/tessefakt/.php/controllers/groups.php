<?php
namespace tessefakt\apps\tessefakt\controllers;
class groups extends \tessefakt\controller{
	public function create(array $data):array{
		$aReturn=[];
		foreach($data as $aGroup) $aReturn[]=$this->app->group->create($data);
		return $aReturn;
	}
}
<?php
namespace tessefakt\apps\tessefakt\controllers;
class users_groups extends \tessefakt\controller{
	public function create(array $users,array $groups):array{
		$aReturn=[];
		foreach($users as $iUser) $aReturn[]=$this->app->user_groups->create($iUser,$groups);
		return $aReturn;
	}
}
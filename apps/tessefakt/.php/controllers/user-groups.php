<?php
namespace tessefakt\apps\tessefakt\controllers;
class user_groups extends \tessefakt\controller{
	public function create(int $user,array $groups):array{
		$aReturn=[];
		foreach($groups as $iGroup) $aReturn[]=$this->app->user_group->create($user,$iGroup);
		return $aReturn;
	}
}
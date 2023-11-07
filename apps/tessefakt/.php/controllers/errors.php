<?php
namespace tessefakt\apps\tessefakt\controllers;
class errors extends \tessefakt\controller{
	public function create(int|string|null $user,array $data):int{
		$aReturn=[];
		foreach($data as $aError) $aReturn[]=$this->app->error->create($user,$aError);
		return $aReturn;
	}
}
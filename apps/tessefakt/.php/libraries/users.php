<?php
namespace tessefakt\apps\tessefakt\controllers;
class users extends \tessefakt\library{
	public function create(array $data):array{
		$aReturn=[];
		foreach($data as $aUser) $aReturn[]=$this->user->create($aUser);
		return $aReturn;
	}
}
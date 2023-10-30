<?php
namespace tessefakt\apps\tessefakt\controllers;
class install extends \tessefakt\controller{
	public function setup(){
		$iGroup=$this->app->groups->create([
			'name'=>'Admins'
		]);
		$this->app->users->create([
			'group'=>$iGroup,
			'email'=>'florian.kerl@gadvelop.de',
			'uid'=>'Florian',
			'password'=>'Sxuyq783!'
		]);
	}
}

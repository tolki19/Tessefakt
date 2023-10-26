<?php
namespace tessefakt\apps\tessefakt\controllers;
class install extends \tessefakt\controller{
	public function setup(){
		$this->app->users->create([
			'email'=>'florian.kerl@gadvelop.de',
			'uid'=>'Florian',
			'password'=>'Sxuyq783!'
		]);
	}
}

<?php
namespace tessefakt\apps\tessefakt\controllers;
class install extends \tessefakt\controller{
	public function setup(){
		$aSettings=[];
		// foreach(whatever){
		// 	$aSettings=$this->app->settings->create();
		// }
		$aApps=[];
		foreach($this->tessefakt->setup['apps'] as $sKey=>$aApp){
			$aApps[$sKey]=$this->app->apps->create([
				'key'=>$sKey,
				'name'=>$aApp['app']['name'],
				'major'=>$aApp['version']['major'],
				'minor'=>$aApp['version']['minor'],
				'build'=>$aApp['version']['build'],
				'caption'=>$aApp['version']['caption']
			]);
		}
		$aGroups['admin']=$this->app->groups->create(
			$aApps,
			[
				'name'=>'Admins'
			]
		);
		$this->app->users->create(
			$aApps,
			$aGroups,
			[
				'email'=>'florian.kerl@gadvelop.de',
				'uid'=>'Florian',
				'password'=>'Sxuyq783!'
			]
		);
	}
}

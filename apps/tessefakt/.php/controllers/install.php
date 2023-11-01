<?php
namespace tessefakt\apps\tessefakt\controllers;
class install extends \tessefakt\controller{
	public function setup(){
		if(!key_exists('tessefakt',$this->tessefakt->setup['apps'])) throw new \Exception('App not configured');
		$aSettings=[];
		// foreach(whatever){
		// 	$aSettings=$this->app->settings->create();
		// }
		$aApps['tessefakt']=$this->app->apps->create([
			'key'=>'tessefakt',
			'name'=>$this->tessefakt->setup['apps']['tessefakt']['app']['name'],
			'major'=>$this->tessefakt->setup['apps']['tessefakt']['version']['major'],
			'minor'=>$this->tessefakt->setup['apps']['tessefakt']['version']['minor'],
			'build'=>$this->tessefakt->setup['apps']['tessefakt']['version']['build'],
			'caption'=>$this->tessefakt->setup['apps']['tessefakt']['version']['caption']
		]);
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

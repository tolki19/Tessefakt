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
			'caption'=>$this->tessefakt->setup['apps']['tessefakt']['version']['caption'],
			'tables'=>['_apps','_groups','_users','_user-_group','_errors','_user-uids','_user-emails','_user-hashes','_app-tables','_app-db-touches','_app-tpl-touches','_app-controller-method-touches','_app-tpl-rights','_app-_group-tpl-rights','_app-_user-tpl-rights','_app-db-rights','_app-_group-db-rights','_app-_user-db-rights','_app-controller-method-rights','_app-_group-controller-method-rights','_app-_user-controller-method-rights','_settings','_group-_setting','_user-_setting','_user-email-state','_user-uid-state','_user-hash-state']
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

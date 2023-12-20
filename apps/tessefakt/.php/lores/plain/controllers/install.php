<?php
namespace tessefakt\apps\tessefakt\lores\plain\controllers;
class install extends \tessefakt\controller{
	public function create_structure():void{
var_dump(2);
	}
	public function create_data():void{
		$aSettings=[];
		$aApps=[];
		$aGroups=[];
		$aUsers=[];
		// foreach(whatever){
		// 	$aSettings=$this->app->settings->create();
		// }
		$aApps['tessefakt']=$this->app->lores->internal->controllers->app->create_app(
			[
				'key'=>'tessefakt',
				'name'=>$this->tessefakt->setup['apps']['tessefakt']['app']['name'],
				'major'=>$this->tessefakt->setup['apps']['tessefakt']['version']['major'],
				'minor'=>$this->tessefakt->setup['apps']['tessefakt']['version']['minor'],
				'build'=>$this->tessefakt->setup['apps']['tessefakt']['version']['build'],
				'caption'=>$this->tessefakt->setup['apps']['tessefakt']['version']['caption']
			]
		);
		$this->app->lores->internal->controllers->app_tables->create_tables(
			$aApps['tessefakt'],
			['_apps','_groups','_users','_user-_group','_errors','_user-uids','_user-emails','_user-hashes','_app-tables','_app-db-touches','_app-tpl-touches','_app-controller-method-touches','_app-tpl-rights','_app-_group-tpl-rights','_app-_user-tpl-rights','_app-db-rights','_app-_group-db-rights','_app-_user-db-rights','_app-controller-method-rights','_app-_group-controller-method-rights','_app-_user-controller-method-rights','_settings','_group-_setting','_user-_setting','_user-email-state','_user-uid-state','_user-hash-state']
		);
		$aGroups['admin']=$this->app->lores->internal->controllers->group->create(
			[
				'name'=>'Admins'
			]
		);
		$aUsers['florian']=$this->app->lores->internal->controllers->user->create(
			[
				'email'=>'florian.kerl@gadvelop.de',
				'uid'=>'Florian',
				'password'=>'Sxuyq783!'
			]
		);
		$this->app->lores->internal->controllers->user->groups->create(
			$aUsers['florian'],
			$aGroups['admin'],
			[]
		);
	}
}

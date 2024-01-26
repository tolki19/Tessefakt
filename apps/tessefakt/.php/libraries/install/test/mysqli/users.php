<?php
namespace tessefakt\apps\tessefakt\libraries\install\test\mysqli;
class users extends \tessefakt\library{
	public function probe():bool{
		$this->app->libraries->mysqli->subs->structure->create();
		$aIds=$this->_data();
		return $this->app->libraries->install->subs->test->validate(
			result:$this->app->libraries->users->subs->emails->read(where:['_user'=>$aIds['users']['florian']],order:['`sort` asc']),
			file:'users-email.json',
		);
		return $bReturn;
	}
	protected function _data():array{
		$aReturn=[];
		// $aReturn['apps']['tessefakt']=$this->app->libraries->apps->create(
		// 	key:'tessefakt',
		// 	name:$this->tessefakt->setup['apps']['tessefakt']['app']['name'],
		// 	major:$this->tessefakt->setup['apps']['tessefakt']['version']['major'],
		// 	minor:$this->tessefakt->setup['apps']['tessefakt']['version']['minor'],
		// 	build:$this->tessefakt->setup['apps']['tessefakt']['version']['build'],
		// 	caption:$this->tessefakt->setup['apps']['tessefakt']['version']['caption']
		// );
		// $aTables=['_apps','_groups','_users','_users-_group','_errors','_users-uids','_users-emails','_users-hashes','_apps-tables','_apps-db-touches','_apps-tpl-touches','_apps-controller-method-touches','_apps-tpl-rights','_apps-_group-tpl-rights','_apps-_users-tpl-rights','_apps-db-rights','_apps-_group-db-rights','_apps-_users-db-rights','_apps-controller-method-rights','_apps-_group-controller-method-rights','_apps-_users-controller-method-rights','_settings','_group-_setting','_users-_setting','_users-emails-state','_users-uids-state','_users-hashes-state'];
		// foreach($aTables as $sTable){
		// 	$this->app->libraries->apps->subs->tables->create(
		// 		app:$aReturn['apps']['tessefakt'],
		// 		table:$sTable,
		// 		version:"1.0.0",
		// 	);
		// }
		$aReturn['groups']['admin']=$this->app->libraries->groups->create(
			name:'Admins'
		);
		$aReturn['users']['florian']=$this->app->libraries->users->create();
		$this->app->libraries->users->subs->emails->create(
			user:$aReturn['users']['florian'],
			email:'florian.kerl@gadvelop.de',
			sort:0,
			valid_from:'2024-01-01',
		);
		$this->app->libraries->users->subs->emails->create(
			user:$aReturn['users']['florian'],
			email:'info@gadvelop.de',
			sort:0,
			valid_from:'2024-01-01',
		);
		$this->app->libraries->users->subs->emails->create(
			user:$aReturn['users']['florian'],
			email:'info@tolk.de',
			sort:-10,
			valid_from:'2024-01-01',
		);
		$this->app->libraries->users->subs->emails->create(
			user:$aReturn['users']['florian'],
			email:'ft@tolk.de',
			sort:758,
			valid_from:'2024-01-01',
		);
		$this->app->libraries->users->subs->uids->create(
			user:$aReturn['users']['florian'],
			uid:'Florian',
		);
		$this->app->libraries->users->subs->hashes->create(
			user:$aReturn['users']['florian'],
			password:'Sxuyq783!',
		);
		$this->app->libraries->users->subs->groups->create(
			user:$aReturn['users']['florian'],
			group:$aReturn['groups']['admin']
		);
		return $aReturn;
	}
}

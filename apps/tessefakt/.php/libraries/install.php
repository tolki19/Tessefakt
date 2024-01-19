<?php
namespace tessefakt\apps\tessefakt\libraries;
class install extends \tessefakt\library{
	public function create_structure():void{
$aFiles=$this->_fs(compilepath($this->app->setup['paths']['sql'].'/create'));
foreach($aFiles as $sFile) $this->connectors->db->multi(file_get_contents($sFile));
	}
	public function create_data():void{
		$aSettings=[];
		$aApps=[];
		$aGroups=[];
		$aUsers=[];
		// foreach(whatever){
		// 	$aSettings=$this->app->settings->create();
		// }
		$aApps['tessefakt']=$this->app->libraries->apps->create(
			key:'tessefakt',
			name:$this->tessefakt->setup['apps']['tessefakt']['app']['name'],
			major:$this->tessefakt->setup['apps']['tessefakt']['version']['major'],
			minor:$this->tessefakt->setup['apps']['tessefakt']['version']['minor'],
			build:$this->tessefakt->setup['apps']['tessefakt']['version']['build'],
			caption:$this->tessefakt->setup['apps']['tessefakt']['version']['caption']
		);
		$aTables=['_apps','_groups','_users','_user-_group','_errors','_user-uids','_user-emails','_user-hashes','_app-tables','_app-db-touches','_app-tpl-touches','_app-controller-method-touches','_app-tpl-rights','_app-_group-tpl-rights','_app-_user-tpl-rights','_app-db-rights','_app-_group-db-rights','_app-_user-db-rights','_app-controller-method-rights','_app-_group-controller-method-rights','_app-_user-controller-method-rights','_settings','_group-_setting','_user-_setting','_user-email-state','_user-uid-state','_user-hash-state'];
		foreach($aTables as $sTable){
			$this->app->libraries->apps->subs->tables->create(
				app:$aApps['tessefakt'],
				table:$sTable,
				version:"1.0.0",
			);
		}
		$aGroups['admin']=$this->app->libraries->groups->create(
			name:'Admins'
		);
		$aUsers['florian']=$this->app->libraries->users->create();
		$this->app->libraries->users->subs->emails->create(
			user:$aUsers['florian'],
			email:'florian.kerl@gadvelop.de',
			sort:0,
		);
		$this->app->libraries->users->subs->emails->create(
			user:$aUsers['florian'],
			email:'info@gadvelop.de',
			sort:0,
		);
		$this->app->libraries->users->subs->emails->create(
			user:$aUsers['florian'],
			email:'info@tolk.de',
			sort:-10,
		);
		$this->app->libraries->users->subs->emails->create(
			user:$aUsers['florian'],
			email:'ft@tolk.de',
			sort:758,
		);
		$this->app->libraries->users->subs->uids->create(
			user:$aUsers['florian'],
			uid:'Florian',
		);
		$this->app->libraries->users->subs->hashes->create(
			user:$aUsers['florian'],
			password:'Sxuyq783!',
		);
		$this->app->libraries->users->subs->groups->create(
			user:$aUsers['florian'],
			group:$aGroups['admin']
		);
	}
	protected function _fs(string $path):array|false{
		if(!($aFiles=scandir($path))) return false;
		$aReturn=[];
		foreach($aFiles as $sFile){
			if($sFile=='.'||$sFile=='..') continue;
			$sPath=$path.'/'.$sFile;
			if(is_file($sPath)) $aReturn[]=$sPath;
			else $aReturn=array_merge($aReturn,$this->_fs($sPath));
		}
		return $aReturn;
	}
}

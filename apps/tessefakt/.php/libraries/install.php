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
		$aApps['tessefakt']=$this->app->libraries->app->create(
			key:'tessefakt',
			name:$this->tessefakt->setup['apps']['tessefakt']['app']['name'],
			major:$this->tessefakt->setup['apps']['tessefakt']['version']['major'],
			minor:$this->tessefakt->setup['apps']['tessefakt']['version']['minor'],
			build:$this->tessefakt->setup['apps']['tessefakt']['version']['build'],
			caption:$this->tessefakt->setup['apps']['tessefakt']['version']['caption']
		);
		$this->app->libraries->app->tables->create(
			$aApps['tessefakt'],
			['_apps','_groups','_users','_user-_group','_errors','_user-uids','_user-emails','_user-hashes','_app-tables','_app-db-touches','_app-tpl-touches','_app-controller-method-touches','_app-tpl-rights','_app-_group-tpl-rights','_app-_user-tpl-rights','_app-db-rights','_app-_group-db-rights','_app-_user-db-rights','_app-controller-method-rights','_app-_group-controller-method-rights','_app-_user-controller-method-rights','_settings','_group-_setting','_user-_setting','_user-email-state','_user-uid-state','_user-hash-state']
		);
		$aGroups['admin']=$this->app->libraries->group->create(
			name:'Admins'
		);
		$aUsers['florian']=$this->app->libraries->user->create(
			email:'florian.kerl@gadvelop.de',
			uid:'Florian',
			password:'Sxuyq783!'
		);
		$this->app->libraries->user->groups->create(
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

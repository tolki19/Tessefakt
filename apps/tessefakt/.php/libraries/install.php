<?php
namespace tessefakt\apps\tessefakt\libraries;
class install extends \tessefakt\library{
	public function create_structure():void{
$aFiles=$this->_fs(compilepath($this->app->setup['paths']['sql'].'/create'));
foreach($aFiles as $sFile) $this->connectors->db->multi(file_get_contents($sFile));
	}
	public function test():void{
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
		$aTables=['_apps','_groups','_users','_users-_group','_errors','_users-uids','_users-emails','_users-hashes','_apps-tables','_apps-db-touches','_apps-tpl-touches','_apps-controller-method-touches','_apps-tpl-rights','_apps-_group-tpl-rights','_apps-_users-tpl-rights','_apps-db-rights','_apps-_group-db-rights','_apps-_users-db-rights','_apps-controller-method-rights','_apps-_group-controller-method-rights','_apps-_users-controller-method-rights','_settings','_group-_setting','_users-_setting','_users-emails-state','_users-uids-state','_users-hashes-state'];
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
// var_dump($this->app->libraries->users->subs->emails->read(where:['_user'=>$aUsers['florian']]));
var_dump(json_encode($this->app->libraries->users->subs->emails->read(where:['_user'=>$aUsers['florian']],order:['`sort` asc']),\JSON_THROW_ON_ERROR|\JSON_PRETTY_PRINT));
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
		$this->app->libraries->users->delete(id:$aUsers['florian']);
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

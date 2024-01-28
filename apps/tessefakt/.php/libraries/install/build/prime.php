<?php
namespace tessefakt\apps\tessefakt\libraries\install\build;
class prime extends \tessefakt\library{
	public function create():array{
		return $this->_data();
	}
	protected function _data():array{
		$aReturn=[];
		$aReturn['groups']['admin']=$this->app->libraries->groups->create(
			name:'Admins'
		);
		$aReturn['users']['florian']=$this->app->libraries->users->create();
		$this->app->libraries->users->subs->emails->create(
			user:$aReturn['users']['florian'],
			email:'florian.kerl@gadvelop.de',
			sort:0,
		);
		$this->app->libraries->users->subs->uids->create(
			user:$aReturn['users']['florian'],
			uid:'Florian Kerl',
		);
		$this->app->libraries->users->subs->hashes->create(
			user:$aReturn['users']['florian'],
			password:'Sxuyq783!',
			type:'md5',
		);
		$this->app->libraries->users->subs->groups->create(
			user:$aReturn['users']['florian'],
			group:$aReturn['groups']['admin']
		);
		return $aReturn;
	}
}

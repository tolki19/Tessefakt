<?php
namespace tessefakt\apps\tessefakt\libraries\install\test\users;
class emails extends \tessefakt\library{
	public function test():bool{
		$bReturn=true;
		$bReturn&=$this->create();
	}
	public function create():bool{
		$this->app->libraries->install->subs->build->subs->structure->create();
		$aIds=$this->_data();
		return $this->app->libraries->install->subs->test->validate(
			result:$this->app->libraries->users->subs->emails->read(where:['_user'=>$aIds['users']['florian']],order:['`sort` asc']),
			file:'users-email.json',
		);
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
			valid_from:'2024-01-01',
			state:'test',
		);
		$this->app->libraries->users->subs->emails->create(
			user:$aReturn['users']['florian'],
			email:'info@gadvelop.de',
			sort:0,
			valid_from:'2024-01-01',
			state:'test',
		);
		$this->app->libraries->users->subs->emails->create(
			user:$aReturn['users']['florian'],
			email:'info@tolk.de',
			sort:-10,
			valid_from:'2024-01-01',
			state:'test',
		);
		$this->app->libraries->users->subs->emails->create(
			user:$aReturn['users']['florian'],
			email:'ft@tolk.de',
			sort:758,
			valid_from:'2024-01-01',
			state:'test',
		);
		$this->app->libraries->users->subs->uids->create(
			user:$aReturn['users']['florian'],
			uid:'Florian',
			valid_from:'2024-01-01',
			state:'test',
		);
		$this->app->libraries->users->subs->hashes->create(
			user:$aReturn['users']['florian'],
			password:'Sxuyq783!',
			valid_from:'2024-01-01',
			state:'test',
		);
		$this->app->libraries->users->subs->groups->create(
			user:$aReturn['users']['florian'],
			group:$aReturn['groups']['admin']
			valid_from:'2024-01-01',
		);
		return $aReturn;
	}
}

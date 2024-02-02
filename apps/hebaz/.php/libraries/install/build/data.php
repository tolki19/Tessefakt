<?php
namespace tessefakt\apps\hebaz\libraries\install\build;
class data extends \tessefakt\library{
	public function prime():array{
		return $this->_prime();
	}
	protected function _prime():array{
		$aReturn=[];
		return $aReturn;
	}
	public function migrate():array{
		return $this->_migrate();
	}
	protected function _migrate():array{
		$aReturn=[];
		$aRoles=$this->connectors->migrate->query('select * from `roles`');
		foreach($aRoles as $aRole){
			$iGroup=$this->apps->tessefakt->libraries->groups->create(
				name:$aRole['name']
				internal_remark:'Automatischer Import ('.date("Y-m-d H:i:s").')',
			);
			$aReturn['groups']['keystring'][$aRole['keystring']]=$iGroup;
			$aReturn['groups']['id'][$aRole['id']]=$iGroup;
		}
// admin
// midwife
$aUsers=$this->connectors->migrate->query('select * from `users`');
foreach($aUsers as $aUser){
	$aReturn['users']['id'][$aUser['id']]=$this->apps->tessefakt->libraries->users->create();
	$this->apps->tessefakt->libraries->users->subs->emails->create(
		user:$aReturn['users']['id'][$aUser['id']],
		email:$aUser['email'],
		sort:0,
		state:(!is_null($aUser['email_authentication'])&&!is_null($aUser['sent_password']))?'ok':null,
		internal_remark:'Automatischer Import ('.date("Y-m-d H:i:s").')',
	);
	$this->apps->tessefakt->libraries->users->subs->uids->create(
		user:$aReturn['users']['id'][$aUser['id']],
		uid:$aUser['name'],
		state:(!is_null($aUser['email_authentication'])&&!is_null($aUser['sent_password']))?'ok':null,
		internal_remark:'Automatischer Import ('.date("Y-m-d H:i:s").')',
	);
	$this->apps->tessefakt->libraries->users->subs->hashes->create(
		user:$aReturn['users']['id'][$aUser['id']],
		hash:$aUser['password'],
		type:'sha128',
		state:(!is_null($aUser['email_authentication'])&&!is_null($aUser['sent_password']))?'ok':null,
		internal_remark:'Automatischer Import ('.date("Y-m-d H:i:s").')',
	);
	$this->apps->tessefakt->libraries->users->subs->groups->create(
		user:$aReturn['users']['id'][$aUser['id']],
		group:$aReturn['groups']['id'][$aUser['role']],
		internal_remark:'Automatischer Import ('.date("Y-m-d H:i:s").')',
	);
}
$aLanguages=$this->connectors->migrate->query('select * from languages');
foreach($aLanguages as $aLanguage){
	$aReturn['languages']['id'][$aLanguage['id']]=$this->apps->tessefakt->libraries->languages->create(
		sort:$aLanguage['sort'],
		name:$aLanguage['name'],
		internal_remark:'Automatischer Import ('.date("Y-m-d H:i:s").')',
	);
}
$aRegions=$this->connectors->migrate->query('select * from regions');
foreach($aRegions as $aRegion){
	$aReturn['regions']['id'][$aRegion['id']]=$this->apps->tessefakt->libraries->regions->create(
		sort:$aRegion['sort'],
		name:$aRegion['name'],
		internal_remark:'Automatischer Import ('.date("Y-m-d H:i:s").')',
	);
}
$aServices=$this->connectors->migrate->query('select * from services');
foreach($aServices as $aService){
	$aReturn['services']['id'][$aService['id']]=$this->apps->tessefakt->libraries->services->create(
		sort:$aService['sort'],
		name:$aService['name'],
		internal_remark:'Automatischer Import ('.date("Y-m-d H:i:s").')',
	);
}
$aReturn['cds']['name']['street']=$this->apps->tessefakt->libraries->cds->create(
	sort:0,
	name:'street',
	public_caption:'Straße Hsnr.',
	internal_caption:'Straße Hsnr.',
	internal_remark:'Automatischer Import ('.date("Y-m-d H:i:s").')',
);
$aReturn['cds']['name']['city']=$this->apps->tessefakt->libraries->cds->create(
	sort:1,
	name:'city',
	public_caption:'PLZ Ort',
	internal_caption:'PLZ Ort',
	internal_remark:'Automatischer Import ('.date("Y-m-d H:i:s").')',
);
$aReturn['cds']['name']['email']=$this->apps->tessefakt->libraries->cds->create(
	sort:2,
	name:'email',
	public_caption:'E-Mail',
	internal_caption:'E-Mail',
	internal_remark:'Automatischer Import ('.date("Y-m-d H:i:s").')',
);
$aReturn['cds']['name']['landline']=$this->apps->tessefakt->libraries->cds->create(
	sort:3,
	name:'landline',
	public_caption:'Festnetz',
	internal_caption:'Festnetz',
	internal_remark:'Automatischer Import ('.date("Y-m-d H:i:s").')',
);
$aReturn['cds']['name']['fax']=$this->apps->tessefakt->libraries->cds->create(
	sort:4,
	name:'fax',
	public_caption:'Fax',
	internal_caption:'Fax',
	internal_remark:'Automatischer Import ('.date("Y-m-d H:i:s").')',
);
$aReturn['cds']['mobile']['mobile']=$this->apps->tessefakt->libraries->cds->create(
	sort:5,
	name:'mobile',
	public_caption:'Mobil',
	internal_caption:'Mobil',
	internal_remark:'Automatischer Import ('.date("Y-m-d H:i:s").')',
);
$aPractices=$this->connectors->migrate->query('select * from practices');
foreach($aPractices as $aPractice){
}
$aMidwives=$this->connectors->migrate->query('select * from `midwives`');
foreach($aMidwives as $aMidwife){
	// var_dump($this->connectors->migrate->query('select * from midwife_holidays'));
	// var_dump($this->connectors->migrate->query('select * from midwife_languages'));
	// var_dump($this->connectors->migrate->query('select * from midwife_regions'));
	// var_dump($this->connectors->migrate->query('select * from midwife_services'));
	// var_dump($this->connectors->migrate->query('select * from midwife_vacancies'));
}
$aEvents=$this->connectors->migrate->query('select * from events');
foreach($aEvents as $aEvent){
}
$aPages=$this->connectors->migrate->query('select * from pages');
foreach($aPages as $aPage){
}
$aNavigations=$this->connectors->migrate->query('select * from navigations');
foreach($aNavigations as $aNavigation){
	// var_dump($this->connectors->migrate->query('select * from navigation_pages'));
}
		return $aReturn;
	}
}

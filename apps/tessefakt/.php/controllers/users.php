<?php
namespace tessefakt\apps\tessefakt\controllers;
class users extends \tessefakt\controller{
	public function create(array $apps,array $groups,array $data):int{
		$iUser=$this->_create_user($groups);
		$iEmail=$this->_create_email($iUser,$data['email']);
		$iUid=$this->_create_uid($iUser,$data['uid']);
		$iHash=$this->_create_hash($iUser,$data['password']);
		$iAppSettings=$this->_create_appUserSettings($iUser,$data['appSettings']??[]);
		$iAppControllerMethodRights=$this->_create_appUserControllerMethodRights($iUser,$data['appControllerMethodRights']??[]);
		$iAppDbRights=$this->_create_appUserDbRights($iUser,$data['appDbRights']??[]);
		$iAppTplRights=$this->_create_appUserTplRights($iUser,$data['appTplRights']??[]);
		return $iUser;
	}
	protected function _create_user(array $groups):int{
		$this->dbs->current->query('
			insert into `_users`
			set 
				`id`=default
		');
		$iId=$this->dbs->current->insert();
		$this->dbs->current->query('
			insert into `_users`
			set 
				`id`=default
		');
		return $iId;
	}
	protected function _create_email(int $user,string $email):int{
		$this->dbs->current->query('
			insert into `_user-emails` 
			set 
				`_user`='.$user.',
				`email`="'.$this->dbs->current->escape($email).'",
				`order`=0,
				`valid_from`=curdate()
		');
		$iId=$this->dbs->current->insert();
		$this->dbs->current->query('
			insert into `_user-email-state`
			set
				`_user-email`='.$iId.',
				`state`="waiting",
				`timestamp`=now(),
				`remark`=null,
				`key`="'.$this->key->create().'"
		');
		return $iId;
	}
	protected function _create_uid(int $user,string $uid):int{
		$this->dbs->current->query('
			insert into `_user-uids`
			set 
				`_user`='.$user.',
				`uid`="'.$this->dbs->current->escape($uid).'",
				`valid_from`=curdate()
		');
		$iId=$this->dbs->current->insert();
		$this->dbs->current->query('
			insert into `_user-uid-state`
			set
				`_user-uid`='.$iId.',
				`state`="waiting",
				`timestamp`=now(),
				`remark`=null,
				`key`=null
		');
		return $iId;
	}
	protected function _create_hash(int $user,string $password):int{
		$this->dbs->current->query('
			insert into `_user-hashes` 
			set 
				`_user`='.$user.',
				`type`="bcrypt",
				`hash`="'.$this->hash->create($password).'",
				`valid_from`=curdate()
			');
		$iId=$this->dbs->current->insert();
		$this->dbs->current->query('
			insert into `_user-hash-state`
			set
				`_user-hash`='.$iId.',
				`state`="waiting",
				`timestamp`=now(),
				`remark`=null,
				`key`=null
		');
		return $iId;
	}
	protected function _create_appUserSettings(int $user,array $settings):array{
		$aReturn=[];
		foreach($settings as $mKey=>$aSetting) $aReturn[$mKey]=$this->_create_appUserSetting($user,$aSetting);
		return $aReturn;
	}
	protected function _create_appUserSetting(int $user,array $setting):int{
		$this->dbs->current->query('
			insert into `_user_app-settings`
			set
				`_user`='.$user.'
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
	protected function _create_appUserControllerMethodRights(int $user,array $rights):array{
		$aReturn=[];
		foreach($settings as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appUserControllerMethodRight($user,$aRight);
		return $aReturn;
	}
	protected function _create_appUserControllerMethodRight(int $user,array $right):int{
		$this->dbs->current->query('
			insert into `_user_app-controller-method-rights`
			set
				`_user`='.$user.'
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
	protected function _create_appUserDbRights(int $user,array $rights):array{
		$aReturn=[];
		foreach($settings as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appUserDbRight($user,$aRight);
		return $aReturn;
	}
	protected function _create_appUserDbRight(int $user,array $right):int{
		$this->dbs->current->query('
			insert into `_user_app-db-rights`
			set
				`_user`='.$user.'
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
	protected function _create_appUserTplRights(int $user,array $rights):array{
		$aReturn=[];
		foreach($settings as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appUserTplRight($user,$aRight);
		return $aReturn;
	}
	protected function _create_appUserTplRight(int $user,array $right):int{
		$this->dbs->current->query('
			insert into `_user_app-tpl-rights`
			set
				`_user`='.$user.'
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
}
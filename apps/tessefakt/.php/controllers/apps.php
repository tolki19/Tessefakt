<?php
namespace tessefakt\apps\tessefakt\controllers;
class users extends \tessefakt\controller{
	public function create(array $data):int{
		$iUser=$this->_create_user();
		$iEmail=$this->_create_email($iUser,$data['email']);
		$iUid=$this->_create_uid($iUser,$data['uid']);
		$iHash=$this->_create_hash($iUser,$data['password']);
		$iAppSettings=$this->_create_appSettings($iUser,$data['appSettings']??[]);
		$iAppControllerMethodRights=$this->_create_appControllerMethodRights($iUser,$data['appControllerMethodRights']??[]);
		$iAppDbRights=$this->_create_appDbRights($iUser,$data['appDbRights']??[]);
		$iAppTplRights=$this->_create_appTplRights($iUser,$data['appTplRights']??[]);
		return $iUser;
	}
	protected function _create_user():int{
		$this->dbs->current->query('
			insert into `_users`
			set 
				`id`=default
		');
		return $this->dbs->current->insert();
	}
	protected function _create_email(int $iUser,string $email):int{
		$this->dbs->current->query('
			insert into `_user-emails` 
			set 
				`_user`='.$iUser.',
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
	protected function _create_uid(int $iUser,string $uid):int{
		$this->dbs->current->query('
			insert into `_user-uids`
			set 
				`_user`='.$iUser.',
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
	protected function _create_hash(int $iUser,string $password):int{
		$this->dbs->current->query('
			insert into `_user-hashes` 
			set 
				`_user`='.$iUser.',
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
	protected function _create_appSettings(int $iUser,array $settings):array{
		$aReturn=[];
		foreach($settings as $mKey=>$aSetting) $aReturn[$mKey]=$this->_create_appSetting($iUser,$aSetting);
		return $aReturn;
	}
	protected function _create_appSetting(int $iUser,array $setting):int{
		$this->dbs->current->query('
			insert `into _user_app-settings`
			set
				`_user`='.$iUser.'
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
	protected function _create_appControllerMethodRights(int $iUser,array $rights):array{
		$aReturn=[];
		foreach($settings as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appControllerMethodRight($iUser,$aRight);
		return $aReturn;
	}
	protected function _create_appControllerMethodRight(int $iUser,array $right):int{
		$this->dbs->current->query('
			insert `into _user_app-controller-method-rights`
			set
				`_user`='.$iUser.'
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
	protected function _create_appDbRights(int $iUser,array $rights):array{
		$aReturn=[];
		foreach($settings as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appDbRight($iUser,$aRight);
		return $aReturn;
	}
	protected function _create_appDbRight(int $iUser,array $right):int{
		$this->dbs->current->query('
			insert `into _user_app-db-rights`
			set
				`_user`='.$iUser.'
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
	protected function _create_appTplRights(int $iUser,array $rights):array{
		$aReturn=[];
		foreach($settings as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appTplRight($iUser,$aRight);
		return $aReturn;
	}
	protected function _create_appTplRight(int $iUser,array $right):int{
		$this->dbs->current->query('
			insert `into _user_app-tpl-rights`
			set
				`_user`='.$iUser.'
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
}
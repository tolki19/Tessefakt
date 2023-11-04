<?php
namespace tessefakt\apps\tessefakt\controllers;
class users extends \tessefakt\controller{
	public function create(array $apps,array $groups,array $data):int{
		$iUser=$this->_create_user($groups);
		$iEmail=$this->_create_email($iUser,$data['email']);
		$iUid=$this->_create_uid($iUser,$data['uid']);
		$iHash=$this->_create_hash($iUser,$data['password']);
		$iAppSettings=$this->_create_userSettings($iUser,$data['appSettings']??[]);
		$iAppControllerMethodRights=$this->_create_appsUserControllerMethodRights($apps,$iUser,$data['appControllerMethodRights']??[]);
		$iAppDbRights=$this->_create_appsUserDbRights($apps,$iUser,$data['appDbRights']??[]);
		$iAppTplRights=$this->_create_appsUserTplRights($apps,$iUser,$data['appTplRights']??[]);
		return $iUser;
	}
	protected function _create_user(array $groups):int{
		$this->db->current->query('
			insert into `_users`
			set 
				`id`=default
		');
		$iId=$this->db->current->insert();
		foreach($groups as $iGroup){
			$this->db->current->query('
				insert into `_user-_group`
				set 
					`_user`='.$iId.',
					`_group`='.$iGroup.',
					`valid_from`=curdate()
			');
		}
		return $iId;
	}
	protected function _create_email(int $user,string $email):int{
		$this->db->current->query('
			insert into `_user-emails` 
			set 
				`_user`='.$user.',
				`email`="'.$this->db->current->escape($email).'",
				`order`=0,
				`valid_from`=curdate()
		');
		$iId=$this->db->current->insert();
		$this->db->current->query('
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
		$this->db->current->query('
			insert into `_user-uids`
			set 
				`_user`='.$user.',
				`uid`="'.$this->db->current->escape($uid).'",
				`valid_from`=curdate()
		');
		$iId=$this->db->current->insert();
		$this->db->current->query('
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
		$this->db->current->query('
			insert into `_user-hashes` 
			set 
				`_user`='.$user.',
				`type`="bcrypt",
				`hash`="'.$this->hash->create($password).'",
				`valid_from`=curdate()
			');
		$iId=$this->db->current->insert();
		$this->db->current->query('
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
	protected function _create_userSettings(int $user,array $settings):array{
		$aReturn=[];
		foreach($settings as $mKey=>$aSetting) $aReturn[$mKey]=$this->_create_userSetting(
				$user,
				$aSetting['setting'],
				$aSetting['value'],
				$aSetting['remark']
			);
		return $aReturn;
	}
	protected function _create_userSetting(int $user,string|int $setting,string|int $value,?string $remark):int{
		$this->db->current->query('
			insert into `_user-_setting`
			set
				`_user`='.$user.'`,
				`_setting`="'.$this->db->current->escape($setting).'",
				`value`="'.$this->db->current->escape($value).'",
				`remark`='.(is_null($remark)?'null':'"'.$this->db->current->escape($remark).'"').'
		');
		$iId=$this->db->current->insert();
		return $iId;
	}
	protected function _create_appsUserControllerMethodRights(array $apps,int $user,array $rights):array{
		$aRights=[];
		foreach($apps as $sKey=>$iApp) $aRights[$sKey]=$this->_create_appUserControllerMethodRights($iApp,$user,$rights);
		return $aRights;
	}
	protected function _create_appUserControllerMethodRights(int $app,int $user,array $rights):array{
		$aReturn=[];
		foreach($rights as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appUserControllerMethodRight(
				$user,
				$aRight['controller'],
				$aRight['method'],
				$aRight['right']
			);
		return $aReturn;
	}
	protected function _create_appUserControllerMethodRight(int $app,int $user,string $controller,?string $method,string|int $right):int{
		$this->db->current->query('
			insert into `_app-_user-controller-method-rights`
			set
				`_app`='.$app.',
				`_user`='.$user.',
				`controller`="'.$this->db->current->escape($controller).'",
				`method`='.(is_null($method)?'null':'"'.$this->db->current->escape($method).'"').',
 				`right`="'.$this->db->current->escape($right).'"
		');
		$iId=$this->db->current->insert();
		return $iId;
	}
	protected function _create_appsUserDbRights(array $apps,int $user,array $rights):array{
		$aRights=[];
		foreach($apps as $sKey=>$iApp) $aRights[$sKey]=$this->_create_appUserDbRights($iApp,$user,$rights);
		return $aRights;
	}
	protected function _create_appUserDbRights(int $app,int $user,array $rights):array{
		$aReturn=[];
		foreach($rights as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appUserDbRight(
				$app,
				$user,
				$aRight['table'],
				$aRight['set'],
				$aRight['field'],
				$aRight['right']
			);
		return $aReturn;
	}
	protected function _create_appUserDbRight(int $app,int $user,string $table,string|int|null $set,?string $field,string|int $right):int{
		$this->db->current->query('
			insert into `_app-_user-db-rights`
			set
				`_app`='.$app.',
				`_user`='.$user.',
				`table`="'.$this->db->current->escape($table).'",
				`set`='.(is_null($set)?'null':'"'.$this->db->current->escape($set).'"').',
				`field`='.(is_null($field)?'null':'"'.$this->db->current->escape($field).'"').',
				`right`="'.$this->db->current->escape($right).'"
		');
		$iId=$this->db->current->insert();
		return $iId;
	}
	protected function _create_appsUserTplRights(array $apps,int $user,array $rights):array{
		$aRights=[];
		foreach($apps as $sKey=>$iApp) $aRights[$sKey]=$this->_create_appUserTplRights($iApp,$user,$rights);
		return $aRights;
	}
	protected function _create_appUserTplRights(int $app,int $user,array $rights):array{
		$aReturn=[];
		foreach($rights as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appUserTplRight(
				$app,
				$group,
				$aRight['tpl'],
				$aRight['div'],
				$aRight['right']
			);
		return $aReturn;
	}
	protected function _create_appUserTplRight(int $app,int $user,string $tpl,?string $div,string|int $right):int{
		$this->db->current->query('
			insert into `_app-_user-tpl-rights`
			set
				`_app`='.$app.',
				`_user`='.$user.',
				`tpl`="'.$this->db->current->escape($tpl).'",
				`div`='.(is_null(div)?'null':'"'.$this->db->current->escape($div).'"').',
				`right`="'.$this->db->current->escape($right).'"
		');
		$iId=$this->db->current->insert();
		return $iId;
	}
}
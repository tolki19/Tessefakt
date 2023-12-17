<?php
namespace tessefakt\apps\tessefakt\lores\internal\controllers;
class user extends \tessefakt\controller{
	public function create(array $data):int{
		$iUser=$this->_create();
		$iEmail=$this->app->user_email->create($iUser,$data['email']);
		$iUid=$this->app->user_uid->create($iUser,$data['uid']);
		$iHash=$this->app->user_hash->create($iUser,$data['password']);
	}
	protected function _create():int{
		$this->connectors->db->query('
			insert into `_users`
			set 
				`id`=default
		');
		$iId=$this->connectors->db->insert();
		foreach($groups as $iGroup){
			$this->connectors->db->query('
				insert into `_user-_group`
				set 
					`_user`='.$iId.',
					`_group`='.$iGroup.',
					`valid_from`=curdate()
			');
		}
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
		$this->connectors->db->query('
			insert into `_user-_setting`
			set
				`_user`='.$user.'`,
				`_setting`="'.$this->connectors->db->escape($setting).'",
				`value`="'.$this->connectors->db->escape($value).'",
				`remark`='.(is_null($remark)?'null':'"'.$this->connectors->db->escape($remark).'"').'
		');
		$iId=$this->connectors->db->insert();
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
		$this->connectors->db->query('
			insert into `_app-_user-controller-method-rights`
			set
				`_app`='.$app.',
				`_user`='.$user.',
				`controller`="'.$this->connectors->db->escape($controller).'",
				`method`='.(is_null($method)?'null':'"'.$this->connectors->db->escape($method).'"').',
 				`right`="'.$this->connectors->db->escape($right).'"
		');
		$iId=$this->connectors->db->insert();
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
		$this->connectors->db->query('
			insert into `_app-_user-db-rights`
			set
				`_app`='.$app.',
				`_user`='.$user.',
				`table`="'.$this->connectors->db->escape($table).'",
				`set`='.(is_null($set)?'null':'"'.$this->connectors->db->escape($set).'"').',
				`field`='.(is_null($field)?'null':'"'.$this->connectors->db->escape($field).'"').',
				`right`="'.$this->connectors->db->escape($right).'"
		');
		$iId=$this->connectors->db->insert();
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
		$this->connectors->db->query('
			insert into `_app-_user-tpl-rights`
			set
				`_app`='.$app.',
				`_user`='.$user.',
				`tpl`="'.$this->connectors->db->escape($tpl).'",
				`div`='.(is_null(div)?'null':'"'.$this->connectors->db->escape($div).'"').',
				`right`="'.$this->connectors->db->escape($right).'"
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
<?php
namespace tessefakt\apps\tessefakt\controllers;
class groups extends \tessefakt\controller{
	public function create(array $apps,array $data):int{
		$iGroup=$this->_create_group($data['name']);
		$iAppSettings=$this->_create_appGroupSettings($apps,$iGroup,$data['appSettings']??[]);
		$iAppControllerMethodRights=$this->_create_appGroupControllerMethodRights($apps,$iGroup,$data['appControllerMethodRights']??[]);
		$iAppDbRights=$this->_create_appGroupDbRights($apps,$iGroup,$data['appDbRights']??[]);
		$iAppTplRights=$this->_create_appGroupTplRights($apps,$iGroup,$data['appTplRights']??[]);
		return $iGroup;
	}
	protected function _create_group(string $name):int{
		$this->dbs->current->query('
			insert into `_groups`
			set 
				`name`="'.$this->dbs->current->escape($name).'"
		');
		return $this->dbs->current->insert();
	}
	protected function _create_appGroupSettings(array $apps,int $group,array $settings):array{
		$aReturn=[];
		foreach($settings as $mKey=>$aSetting) $aReturn[$mKey]=$this->_create_appGroupSetting($group,$aSetting);
		return $aReturn;
	}
	protected function _create_appGroupSetting(int $app,int $group,array $setting):int{
		$this->dbs->current->query('
			insert into `_group-_app-settings`
			set
				`_group`='.$group.'
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
	protected function _create_appGroupControllerMethodRights(array $apps,int $group,array $rights):array{
		$aReturn=[];
		foreach($settings as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appGroupControllerMethodRight($group,$aRight);
		return $aReturn;
	}
	protected function _create_appGroupControllerMethodRight(int $app,int $group,array $right):int{
		$this->dbs->current->query('
			insert into `_group-_app-controller-method-rights`
			set
				`_group`='.$group.'
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
	protected function _create_appGroupDbRights(array $apps,int $group,array $rights):array{
		$aReturn=[];
		foreach($settings as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appGroupDbRight($group,$aRight);
		return $aReturn;
	}
	protected function _create_appGroupDbRight(int $app,int $group,array $right):int{
		$this->dbs->current->query('
			insert into `_group-_app-db-rights`
			set
				`_group`='.$group.'
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
	protected function _create_appGroupTplRights(array $apps,int $group,array $rights):array{
		$aReturn=[];
		foreach($settings as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appGroupTplRight($group,$aRight);
		return $aReturn;
	}
	protected function _create_appGroupTplRight(int $app,int $group,array $right):int{
		$this->dbs->current->query('
			insert into `_group-_app-tpl-rights`
			set
				`_group`='.$group.'
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
}
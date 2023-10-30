<?php
namespace tessefakt\apps\tessefakt\controllers;
class groups extends \tessefakt\controller{
	public function create(array $data):int{
		$iGroup=$this->_create_group($data['name']);
		$iAppSettings=$this->_create_appSettings($iGroup,$data['appSettings']??[]);
		$iAppControllerMethodRights=$this->_create_appControllerMethodRights($iGroup,$data['appControllerMethodRights']??[]);
		$iAppDbRights=$this->_create_appDbRights($iGroup,$data['appDbRights']??[]);
		$iAppTplRights=$this->_create_appTplRights($iGroup,$data['appTplRights']??[]);
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
	protected function _create_appSettings(int $group,array $settings):array{
		$aReturn=[];
		foreach($settings as $mKey=>$aSetting) $aReturn[$mKey]=$this->_create_appSetting($group,$aSetting);
		return $aReturn;
	}
	protected function _create_appSetting(int $group,array $setting):int{
		$this->dbs->current->query('
			insert `into _group_app-settings`
			set
				`_group`='.$group.'
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
	protected function _create_appControllerMethodRights(int $group,array $rights):array{
		$aReturn=[];
		foreach($settings as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appControllerMethodRight($group,$aRight);
		return $aReturn;
	}
	protected function _create_appControllerMethodRight(int $group,array $right):int{
		$this->dbs->current->query('
			insert `into _group_app-controller-method-rights`
			set
				`_group`='.$group.'
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
	protected function _create_appDbRights(int $group,array $rights):array{
		$aReturn=[];
		foreach($settings as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appDbRight($group,$aRight);
		return $aReturn;
	}
	protected function _create_appDbRight(int $group,array $right):int{
		$this->dbs->current->query('
			insert `into _group_app-db-rights`
			set
				`_group`='.$group.'
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
	protected function _create_appTplRights(int $group,array $rights):array{
		$aReturn=[];
		foreach($settings as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appTplRight($group,$aRight);
		return $aReturn;
	}
	protected function _create_appTplRight(int $group,array $right):int{
		$this->dbs->current->query('
			insert `into _group_app-tpl-rights`
			set
				`_group`='.$group.'
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
}
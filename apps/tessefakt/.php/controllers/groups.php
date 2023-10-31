<?php
namespace tessefakt\apps\tessefakt\controllers;
class groups extends \tessefakt\controller{
	public function create(array $apps,array $data):int{
		$iGroup=$this->_create_group($data['name']);
		$iAppSettings=$this->_create_groupSettings($iGroup,$data['appSettings']??[]);
		$iAppControllerMethodRights=$this->_create_appsGroupControllerMethodRights($apps,$iGroup,$data['appControllerMethodRights']??[]);
		$iAppDbRights=$this->_create_appsGroupDbRights($apps,$iGroup,$data['appDbRights']??[]);
		$iAppTplRights=$this->_create_appsGroupTplRights($apps,$iGroup,$data['appTplRights']??[]);
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
	protected function _create_groupSettings(int $group,array $settings):array{
		$aReturn=[];
		foreach($settings as $mKey=>$aSetting) $aReturn[$mKey]=$this->_create_groupSetting(
			$group,
			$aSetting['setting'],
			$aSetting['value'],
			$aSetting['remark']
		);
		return $aReturn;
	}
	protected function _create_groupSetting(int $group,string|int $setting,string|int $value,?string $remark):int{
		$this->dbs->current->query('
			insert into `_group-settings`
			set
				`_group`='.$group.',
				`_setting`="'.$this->dbs->current->escape($setting).'",
				`value`="'.$this->dbs->current->escape($value).'",
				`remark`='.(is_null($remark)?'null':'"'.$this->dbs->current->escape($remark).'"').'
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
	protected function _create_appsGroupControllerMethodRights(array $apps,int $group,array $rights):array{
		$aRights=[];
		foreach($apps as $sKey=>$iApp) $aRights[$sKey]=$this->_create_appGroupControllerMethodRights($iApp,$group,$rights);
		return $aRights;
	}
	protected function _create_appGroupControllerMethodRights(int $app,int $group,array $rights):array{
		$aReturn=[];
		foreach($rights as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appGroupControllerMethodRight(
				$app,
				$group,
				$aRight['controller'],
				$aRight['method'],
				$aRight['right']
			);
		return $aReturn;
	}
	protected function _create_appGroupControllerMethodRight(int $app,int $group,string $controller,?string $method,string|int $right):int{
		$this->dbs->current->query('
			insert into `_app-_group-controller-method-rights`
			set
				`_app`='.$app.',
				`_group`='.$group.',
				`controller`="'.$this->dbs->current->escape($controller).'",
				`method`='.(is_null($method)?'null':'"'.$this->dbs->current->escape($method).'"').',
 				`right`="'.$this->dbs->current->escape($right).'"
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
	protected function _create_appsGroupDbRights(array $apps,int $group,array $rights):array{
		$aRights=[];
		foreach($apps as $sKey=>$iApp) $aRights[$sKey]=$this->_create_appGroupDbRights($iApp,$group,$rights);
		return $aRights;
	}
	protected function _create_appGroupDbRights(int $app,int $group,array $rights):array{
		$aReturn=[];
		foreach($rights as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appGroupDbRight(
				$app,
				$group,
				$aRight['table'],
				$aRight['set'],
				$aRight['field'],
				$aRight['right']
			);
		return $aReturn;
	}
	protected function _create_appGroupDbRight(int $app,int $group,string $table,string|int|null $set,?string $field,string|int $right):int{
		$this->dbs->current->query('
			insert into `_app-_group-db-rights`
			set
				`_app`='.$app.',
				`_group`='.$group.',
				`table`="'.$this->dbs->current->escape($table).'",
				`set`='.(is_null($set)?'null':'"'.$this->dbs->current->escape($set).'"').',
				`field`='.(is_null($field)?'null':'"'.$this->dbs->current->escape($field).'"').',
				`right`="'.$this->dbs->current->escape($right).'"
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
	protected function _create_appsGroupTplRights(array $apps,int $group,array $rights):array{
		$aRights=[];
		foreach($apps as $sKey=>$iApp) $aRights[$sKey]=$this->_create_appGroupTplRights($iApp,$group,$rights);
		return $aRights;
	}
	protected function _create_appGroupTplRights(int $app,int $group,array $rights):array{
		$aReturn=[];
		foreach($rights as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appGroupTplRight(
				$app,
				$group,
				$aRight['tpl'],
				$aRight['div'],
				$aRight['right']
			);
		return $aReturn;
	}
	protected function _create_appGroupTplRight(int $app,int $group,string $tpl,?string $div,string|int $right):int{
		$this->dbs->current->query('
			insert into `_app-_group-tpl-rights`
			set
				`_app`='.$app.',
				`_group`='.$group.',
				`tpl`="'.$this->dbs->current->escape($tpl).'",
				`div`='.(is_null(div)?'null':'"'.$this->dbs->current->escape($div).'"').',
				`right`="'.$this->dbs->current->escape($right).'"
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
}
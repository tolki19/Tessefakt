<?php
namespace tessefakt\apps\tessefakt\controllers;
class apps extends \tessefakt\controller{
	public function create(array $data):int{
		$iApp=$this->_create_app(
			$data['key'],
			$data['name'],
			$data['major'],
			$data['minor'],
			$data['build'],
			$data['caption']
		);
		$iAppSettings=$this->_create_appSettings($iApp,$data['appSettings']??[]);
		$iAppControllerMethodRights=$this->_create_appControllerMethodRights($iApp,$data['appControllerMethodRights']??[]);
		$iAppDbRights=$this->_create_appDbRights($iApp,$data['appDbRights']??[]);
		$iAppTplRights=$this->_create_appTplRights($iApp,$data['appTplRights']??[]);
		return $iApp;
	}
	protected function _create_app(string $key,string $name,string $major,string $minor,string $build,string $caption):int{
		$this->dbs->current->query('
			insert into `_apps`
			set 
				`key`="'.$this->dbs->current->escape($key).'",
				`name`="'.$this->dbs->current->escape($name).'",
				`major`="'.$this->dbs->current->escape($major).'",
				`minor`="'.$this->dbs->current->escape($minor).'",
				`build`="'.$this->dbs->current->escape($build).'",
				`caption`="'.$this->dbs->current->escape($caption).'"
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
	protected function _create_appSettings(int $app,array $settings):array{
		$aReturn=[];
		foreach($settings as $mKey=>$aSetting) $aReturn[$mKey]=$this->_create_appSetting($app,$aSetting);
		return $aReturn;
	}
	protected function _create_appSetting(int $app,array $setting):int{
		$this->dbs->current->query('
			insert into `_app-settings`
			set
				`_app`='.$app.'
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
	protected function _create_appControllerMethodRights(int $app,array $rights):array{
		$aReturn=[];
		foreach($settings as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appControllerMethodRight($app,$aRight);
		return $aReturn;
	}
	protected function _create_appControllerMethodRight(int $app,array $right):int{
		$this->dbs->current->query('
			insert into `_app-controller-method-rights`
			set
				`_app`='.$app.'
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
	protected function _create_appDbRights(int $app,array $rights):array{
		$aReturn=[];
		foreach($settings as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appDbRight($app,$aRight);
		return $aReturn;
	}
	protected function _create_appDbRight(int $app,array $right):int{
		$this->dbs->current->query('
			insert into `_app-db-rights`
			set
				`_app`='.$app.'
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
	protected function _create_appTplRights(int $app,array $rights):array{
		$aReturn=[];
		foreach($settings as $mKey=>$aRight) $aReturn[$mKey]=$this->_create_appTplRight($app,$aRight);
		return $aReturn;
	}
	protected function _create_appTplRight(int $app,array $right):int{
		$this->dbs->current->query('
			insert into `_app-tpl-rights`
			set
				`_app`='.$app.'
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
}
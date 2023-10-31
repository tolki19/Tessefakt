<?php
namespace tessefakt\apps\tessefakt\controllers;
class settings extends \tessefakt\controller{
	public function create(array $data):int{
		$iSetting=$this->_create_setting(
			$data['key'],
			$data['caption'],
			$data['keywords'],
			$data['value'],
			$data['remark']
		);
		return $iSetting;
	}
	protected function _create_setting(string $key,string $caption,string $keywords,string $value,?string $remark):int{
		$this->dbs->current->query('
			insert into `_apps`
			set 
				`key`="'.$this->dbs->current->escape($key).'",
				`caption`="'.$this->dbs->current->escape($caption).'",
				`keywords`="'.$this->dbs->current->escape($keywords).'",
				`value`="'.$this->dbs->current->escape($value).'",
				`remark`='.(is_null($remark)?'null':'"'.$this->dbs->current->escape($remark).'"').'
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
}
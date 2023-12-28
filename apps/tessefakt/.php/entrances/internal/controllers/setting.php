<?php
namespace tessefakt\apps\tessefakt\entrances\internal\controllers;
class setting extends \tessefakt\controller{
	public function create(array $data):int{
		$iSetting=$this->_create(
			$data['key'],
			$data['caption'],
			$data['keywords'],
			$data['value'],
			$data['remark']
		);
		return $iSetting;
	}
	protected function _create(string $key,string $caption,string $keywords,string $value,?string $remark):int{
		$this->connectors->db->query('
			insert into `_settings`
			set 
				`key`="'.$this->connectors->db->escape($key).'",
				`caption`="'.$this->connectors->db->escape($caption).'",
				`keywords`="'.$this->connectors->db->escape($keywords).'",
				`value`="'.$this->connectors->db->escape($value).'",
				`remark`='.(is_null($remark)?'null':'"'.$this->connectors->db->escape($remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
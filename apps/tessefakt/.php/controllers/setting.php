<?php
namespace tessefakt\apps\tessefakt\controllers;
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
		$this->db->current->query('
			insert into `_apps`
			set 
				`key`="'.$this->db->current->escape($key).'",
				`caption`="'.$this->db->current->escape($caption).'",
				`keywords`="'.$this->db->current->escape($keywords).'",
				`value`="'.$this->db->current->escape($value).'",
				`remark`='.(is_null($remark)?'null':'"'.$this->db->current->escape($remark).'"').'
		');
		$iId=$this->db->current->insert();
		return $iId;
	}
}
<?php
namespace tessefakt\apps\tessefakt\controllers;
class group_setting extends \tessefakt\controller{
	public function create(int $group,int $setting,array $data):int{
		$iSetting=$this->_create(
			$group,
			$setting,
			$data['value'],
			$data['remark']
		);
		return $iSetting;
	}
	protected function _create(int $group,int $setting,string $key,string $value,?string $remark):int{
		$this->db->current->query('
			insert into `_group-_settings`
			set 
				`_group`='.$group.',
				`_setting`='.$setting.',
				`value`="'.$this->db->current->escape($value).'",
				`remark`='.(is_null($remark)?'null':'"'.$this->db->current->escape($remark).'"').'
		');
		$iId=$this->db->current->insert();
		return $iId;
	}
}
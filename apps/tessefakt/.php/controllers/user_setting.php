<?php
namespace tessefakt\apps\tessefakt\controllers;
class user_setting extends \tessefakt\controller{
	public function create(int $user,int $setting,array $data):int{
		$iSetting=$this->_create(
			$user,
			$setting,
			$data['value'],
			$data['remark']
		);
		return $iSetting;
	}
	protected function _create(int $user,int $setting,string $value,?string $remark):int{
		$this->db->current->query('
			insert into `_user-_setting`
			set 
				`_user`='.$user.',
				`_setting`='.$setting.',
				`value`="'.$this->db->current->escape($value).'",
				`remark`='.(is_null($remark)?'null':'"'.$this->db->current->escape($remark).'"').'
		');
		$iId=$this->db->current->insert();
		return $iId;
	}
}
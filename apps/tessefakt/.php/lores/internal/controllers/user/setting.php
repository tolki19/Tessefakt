<?php
namespace tessefakt\apps\tessefakt\lores\internal\controllers\user;
class setting extends \tessefakt\controller{
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
		$this->connectors->db->query('
			insert into `_user-_setting`
			set 
				`_user`='.$user.',
				`_setting`='.$setting.',
				`value`="'.$this->connectors->db->escape($value).'",
				`remark`='.(is_null($remark)?'null':'"'.$this->connectors->db->escape($remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
<?php
namespace tessefakt\apps\tessefakt\entries\internal\controllers\group;
class setting extends \tessefakt\controller{
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
		$this->connectors->db->query('
			insert into `_group-_settings`
			set 
				`_group`='.$group.',
				`_setting`='.$setting.',
				`value`="'.$this->connectors->db->escape($value).'",
				`remark`='.(is_null($remark)?'null':'"'.$this->connectors->db->escape($remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
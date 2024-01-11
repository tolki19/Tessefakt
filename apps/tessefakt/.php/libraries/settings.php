<?php
namespace tessefakt\apps\tessefakt\libraries;
class settings extends \tessefakt\library{
	public function create(array $data):int{
		$iSetting=$this->_create(
			$data['_app']??null,
			$data['_group']??null,
			$data['_user']??null,
			$data['key'],
			$data['caption'],
			$data['keywords'],
			$data['value'],
			$data['remark']??null
		);
		return $iSetting;
	}
	protected function _create(int|null $app,int|null $group,int|null $user,string $key,string $caption,string $keywords,string $value,string|null $remark):int{
		$this->connectors->db->query('
			insert into `_settings`
			set 
				`_app`='.($app??'null').',
				`_group`='.($group??'null').',
				`_user`='.($user??'null').',
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
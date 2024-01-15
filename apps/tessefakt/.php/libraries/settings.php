<?php
namespace tessefakt\apps\tessefakt\libraries;
class settings extends \tessefakt\library{
	public function create(
		string $key,
		string $caption,
		string $keywords,
		string $value,
		int|null $app=null,
		int|null $group=null,
		int|null $user=null,
		string|null $remark=null
	):int{
		$iSetting=$this->_create(
			key:$key,
			caption:$caption,
			keywords:$keywords,
			value:$value,
			app:$app,
			group:$group,
			user:$user,
			remark:$remark
		);
		return $iSetting;
	}
	protected function _create(
		string $key,
		string $caption,
		string $keywords,
		string $value,
		int|null $app,
		int|null $group,
		int|null $user,
		string|null $remark
	):int{
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
	public function update(
		int $id,
		string $key,
		string $caption,
		string $keywords,
		string $value,
		int|null $app=null,
		int|null $group=null,
		int|null $user=null,
		string|null $remark=null
	):int{
		$iSetting=$this->_update(
			id:$id,
			key:$key,
			caption:$caption,
			keywords:$keywords,
			value:$value,
			app:$app,
			group:$group,
			user:$user,
			remark:$remark
		);
		return $iSetting;
	}
	protected function _update(
		int $id,
		string $key,
		string $caption,
		string $keywords,
		string $value,
		int|null $app,
		int|null $group,
		int|null $user,
		string|null $remark
	):int{
		$this->connectors->db->query('
			update `_settings`
			set 
				`_app`='.($app??'null').',
				`_group`='.($group??'null').',
				`_user`='.($user??'null').',
				`key`="'.$this->connectors->db->escape($key).'",
				`caption`="'.$this->connectors->db->escape($caption).'",
				`keywords`="'.$this->connectors->db->escape($keywords).'",
				`value`="'.$this->connectors->db->escape($value).'",
				`remark`='.(is_null($remark)?'null':'"'.$this->connectors->db->escape($remark).'"').'
			where `id`='.$id.'
		');
		return $id;
	}
}
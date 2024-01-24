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
	public function read(
		array|null $columns=null,
		array|null $where=null,
		array|null $order=null,
		array|null $limit=null,
	):array{
		return $this->_read(
			columns:$columns,
			where:$where,
			order:$order,
			limit:$limit,
		);
	}
	protected function _read(
		array|null $columns,
		array|null $where,
		array|null $order,
		array|null $limit,
	):array{
		return $this->connectors->db->query('
			select '.(is_null($columns)||!count($columns)?'*':'`'.implode('`,`',$columns).'`').'
			from `_settings`
			where '.(is_null($where)||!count($where)?'1':implode(' and ',array_recombine($where,function($key,$value){ return '`'.$key.'`='.(is_null($value)?'null':'"'.$this->connectors->db->escape($value).'"'); }))).'
			'.(is_null($order)||!count($order)?'':'order '.implode(',',$order)).'
			'.(is_null($limit)||!count($limit)?'':implode(' ',array_filter([(isset($limit['offset'])?'offset '.$limit['offset']:''),(isset($limit['fetch'])?' fetch '.$limit['fetch']:'')],'strlen'))).'
		');
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
	public function delete(
		int $id,
	):int{
		$iSetting=$this->_delete(
			id:$id,
		);
		return $iSetting;
	}
	protected function _delete(
		int $id,
	):int{
		$this->connectors->db->query('
			delete from `_settings`
			where `id`='.$id.'
		');
		return $id;
	}
}
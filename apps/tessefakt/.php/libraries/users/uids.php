<?php
namespace tessefakt\apps\tessefakt\libraries\users;
class uids extends \tessefakt\library{
	public function create(
		int $user,
		string $uid,
		int|string|null $valid_from=null,
		int|string|null $valid_till=null,
		string|null $state=null,
	):int{
		return $this->_create(
			user:$user,
			uid:$uid,
			state:$state??'queued',
			valid_from:$valid_from,
			valid_till:$valid_till,
		);
	}
	protected function _create(
		int $user,
		string $uid,
		int|string|null $valid_from=null,
		int|string|null $valid_till=null,
		string $state,
	):int{
		$this->connectors->db->query('
			insert into `_users-uids`
			set 
				`_user`='.$user.',
				`uid`="'.$this->connectors->db->escape($uid).'",
				`valid_from`='.(is_null($valid_from)?'curdate()':(is_int($valid_from)?'"'.date('Y-m-d H:i:s',$valid_from).'"':'"'.$this->connectors->db->escape($valid_from).'"')).',
				`valid_till`='.(is_null($valid_till)?'null':(is_int($valid_till)?'"'.date('Y-m-d H:i:s',$valid_till).'"':'"'.$this->connectors->db->escape($valid_till).'"')).'
		');
		$iId=$this->connectors->db->insert();
		$this->connectors->db->query('
			insert into `_users-uids-state`
			set
				`_users-uid`='.$iId.',
				`state`="'.$this->connectors->db->escape($state).'",
				`timestamp`=now(),
				`remark`=null,
				`key`=null
		');
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
			from `_users-uids`
			where '.(is_null($where)||!count($where)?'1':implode(' and ',array_recombine($where,function($key,$value){ return '`'.$key.'`='.(is_null($value)?'null':'"'.$this->connectors->db->escape($value).'"'); }))).'
			'.(is_null($order)||!count($order)?'':'order by '.implode(',',$order)).'
			'.(is_null($limit)||!count($limit)?'':implode(' ',array_filter([(isset($limit['offset'])?'offset '.$limit['offset']:''),(isset($limit['fetch'])?' fetch '.$limit['fetch']:'')],'strlen'))).'
		');
	}
	public function update(
		int $id,
		int $user,
		string $uid,
		int|string|null $valid_from=null,
		int|string|null $valid_till=null,
		string|null $state,
	):int{
		return $this->_update(
			id:$id,
			user:$user,
			uid:$uid,
			valid_from:$valid_from,
			valid_till:$valid_till,
			state:$state??'queued',
		);
	}
	protected function _update(
		int $id,
		int $user,
		string $uid,
		int|string|null $valid_from,
		int|string|null $valid_till,
		string $state,
	):int{
		$this->connectors->db->query('
			update `_users-uids`
			set 
				`_user`='.$user.',
				`uid`="'.$this->connectors->db->escape($uid).'",
				`valid_from`='.(is_null($valid_from)?'curdate()':(is_int($valid_from)?'"'.date('Y-m-d H:i:s',$valid_from).'"':'"'.$this->connectors->db->escape($valid_from).'"')).',
				`valid_till`='.(is_null($valid_till)?'null':(is_int($valid_till)?'"'.date('Y-m-d H:i:s',$valid_till).'"':'"'.$this->connectors->db->escape($valid_till).'"')).'
			where `id`='.$id.'
		');
		return $id;
	}
	public function delete(
		int $id,
	):int{
		return $this->_delete(
			id:$id,
		);
	}
	protected function _delete(
		int $id,
	):int{
		$this->connectors->db->query('
			delete from `_users-uids`
			where `id`='.$id.'
		');
		return $id;
	}
}
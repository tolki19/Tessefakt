<?php
namespace tessefakt\apps\tessefakt\libraries\users;
class uids extends \tessefakt\library{
	public function create(
		int $user,
		string $uid
	):int{
		return $this->_create(
			user:$user,
			uid:$uid
		);
	}
	protected function _create(
		int $user,
		string $uid
	):int{
		$this->connectors->db->query('
			insert into `_user-uids`
			set 
				`_user`='.$user.',
				`uid`="'.$this->connectors->db->escape($uid).'",
				`valid_from`=curdate()
		');
		$iId=$this->connectors->db->insert();
		$this->connectors->db->query('
			insert into `_user-uid-state`
			set
				`_user-uid`='.$iId.',
				`state`="waiting",
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
			from `_user-uids`
			where '.(is_null($where)||!count($where)?'1':implode(' and ',array_recombine($where,function($key,$value){ return '`'.$key.'`='.(is_null($value)?'null':'"'.$this->connectors->db->escape($value).'"'); }))).'
			'.(is_null($order)||!count($order)?'':'order '.implode(',',array_recombine($order,function($key,$value){ return '`'.$key.'` '.(is_null($value)?'asc':$value); }))).'
			'.(is_null($limit)||!count($limit)?'':implode(' ',array_filter([(isset($limit['offset'])?'offset '.$limit['offset']:''),(isset($limit['fetch'])?' fetch '.$limit['fetch']:'')],'strlen'))).'
		');
	}
	public function update(
		int $id,
		int $user,
		string $uid
	):int{
		return $this->_update(
			id:$id,
			user:$user,
			uid:$uid
		);
	}
	protected function _update(
		int $id,
		int $user,
		string $uid
	):int{
		$this->connectors->db->query('
			update `_user-uids`
			set 
				`_user`='.$user.',
				`uid`="'.$this->connectors->db->escape($uid).'",
				`valid_from`=curdate()
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
			delete `_user-uids`
			where `id`='.$id.'
		');
		return $id;
	}
}
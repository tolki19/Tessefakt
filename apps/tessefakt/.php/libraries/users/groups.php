<?php
namespace tessefakt\apps\tessefakt\libraries\users;
class groups extends \tessefakt\library{
	public function create(
		int $user,
		int $group,
		string|null $valid_from=null,
		string|null $valid_till=null
	):int{
		return $this->_create(
			user:$user,
			group:$group,
			valid_from:$valid_from,
			valid_till:$valid_till
		);
	}
	protected function _create(
		int $user,
		int $group,
		string|null $valid_from,
		string|null $valid_till
	):int{
		return $this->connectors->db->query('
			insert into `_users-_group`
			set 
				`_user`='.$user.',
				`_group`='.$group.',
				`valid_from`='.(is_null($valid_from)?'curdate()':'"'.$this->connectors->db->escape($valid_from).'"').',
				`valid_till`='.(is_null($valid_till)?'null':'"'.$this->connectors->db>escape($valid_till).'"').'
		');
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
			from `_users-_group`
			where '.(is_null($where)||!count($where)?'1':implode(' and ',array_recombine($where,function($key,$value){ return '`'.$key.'`='.(is_null($value)?'null':'"'.$this->connectors->db->escape($value).'"'); }))).'
			'.(is_null($order)||!count($order)?'':'order '.implode(',',$order)).'
			'.(is_null($limit)||!count($limit)?'':implode(' ',array_filter([(isset($limit['offset'])?'offset '.$limit['offset']:''),(isset($limit['fetch'])?' fetch '.$limit['fetch']:'')],'strlen'))).'
		');
	}
	public function update(
		int $id,
		int $user,
		int $group,
		string|null $valid_from=null,
		string|null $valid_till=null
	):int{
		return $this->_update(
			id:$id,
			user:$user,
			group:$group,
			valid_from:$valid_from,
			valid_till:$valid_till
		);
	}
	protected function _update(
		int $id,
		int $user,
		int $group,
		string|null $valid_from,
		string|null $valid_till
	):int{
		$this->connectors->db->query('
			update `_users-_group`
			set 
				`_user`='.$user.',
				`_group`='.$group.',
				`valid_from`='.(isnull($valid_from)?'curdate()':'"'.$this->connectors->db->escape($valid_from).'"').',
				`valid_till`='.(isnull($valid_till)?'null':'"'.$this->connectors->db>escape($valid_till).'"').'
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
			delete from `_users-_group`
			where `id`='.$id.'
		');
		return $id;
	}
}
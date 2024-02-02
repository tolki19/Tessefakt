<?php
namespace tessefakt\apps\tessefakt\libraries\users;
class emails extends \tessefakt\library{
	public function create(
		int $user,
		string $email,
		int $sort=0,
		int|string|null $valid_from=null,
		int|string|null $valid_till=null,
		string|null $state=null,
		string|null $internal_remark=null,
	):int{
		return $this->_create(
			user:$user,
			email:$email,
			sort:$sort,
			valid_from:$valid_from,
			valid_till:$valid_till,
			state:$state??'queued',
			internal_remark:$internal_remark,
		);
	}
	protected function _create(
		int $user,
		string $email,
		int $sort,
		int|string|null $valid_from,
		int|string|null $valid_till,
		string $state,
		string|null $internal_remark,
	):int{
		$this->connectors->db->transaction();
		$this->connectors->db->query('
			select @sort:=least(greatest('.$sort.',0),ifnull(count(*),0))
			from `_users-emails`
			where `_user`='.$user.'
		');
		$this->connectors->db->query('
			insert into `_users-emails` 
			set 
				`_user`='.$user.',
				`email`="'.$this->connectors->db->escape($email).'",
				`sort`=@sort,
				`valid_from`='.(is_null($valid_from)?'curdate()':(is_int($valid_from)?'"'.date('Y-m-d H:i:s',$valid_from).'"':'"'.$this->connectors->db->escape($valid_from).'"')).',
				`valid_till`='.(is_null($valid_till)?'null':(is_int($valid_till)?'"'.date('Y-m-d H:i:s',$valid_till).'"':'"'.$this->connectors->db->escape($valid_till).'"')).',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		$this->connectors->db->query('
			update `_users-emails`
			set `sort`=`sort`+1
			where `_user`='.$user.' and `sort`>=@sort and `id`!='.$iId.'
		');
		$this->connectors->db->query('
			insert into `_users-emails-state`
			set
				`_users-email`='.$iId.',
				`state`="'.$this->connectors->db->escape($state).'",
				`timestamp`=now(),
				`remark`=null,
				`key`=null
			');
				// `key`="'.$this->key->create().'"
				$this->connectors->db->commit();
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
			from `_users-emails`
			where '.(is_null($where)||!count($where)?'1':implode(' and ',array_recombine($where,function($key,$value){ return '`'.$key.'`='.(is_null($value)?'null':'"'.$this->connectors->db->escape($value).'"'); }))).'
			'.(is_null($order)||!count($order)?'':'order by '.implode(',',$order)).'
			'.(is_null($limit)||!count($limit)?'':implode(' ',array_filter([(isset($limit['offset'])?'offset '.$limit['offset']:''),(isset($limit['fetch'])?' fetch '.$limit['fetch']:'')],'strlen'))).'
		');
	}
	public function update(
		int $id,
		int $user,
		string $email,
		int $sort,
		int|string|null $valid_from=null,
		int|string|null $valid_till=null,
		string|null $internal_remark=null,
	):int{
		return $this->_update(
			id:$id,
			user:$user,
			email:$email,
			sort:$sort,
			valid_from:$valid_from,
			valid_till:$valid_till,
			internal_remark:$internal_remark,
		);
	}
	protected function _update(
		int $id,
		int $user,
		string $email,
		int $sort,
		int|string|null $valid_from,
		int|string|null $valid_till,
		string|null $internal_remark,
	):int{
		$this->connectors->db->transaction();
		$this->connectors->db->query('
			select @sort:=`sort`,@dep:=`_user`
			from `_users-emails`
			where `id`='.$id.'
		');
		$this->connectors->db->query('
			update `_users-emails`
			set `sort`=`sort`-1
			where `_user`=@dep and `sort`>@sort
		');
		$this->connectors->db->query('
			select @sort:=least(greatest('.$sort.',0),ifnull(count(*),0))
			from `_users-emails`
			where `_user`='.$user.' and `id`!='.$id.'
		');
		$this->connectors->db->query('
			update `_users-emails` 
			set 
				`_user`='.$user.',
				`email`="'.$this->connectors->db->escape($email).'",
				`sort`=@sort,
				`valid_from`='.(is_null($valid_from)?'curdate()':(is_int($valid_from)?'"'.date('Y-m-d H:i:s',$valid_from).'"':'"'.$this->connectors->db->escape($valid_from).'"')).'
				`valid_till`='.(is_null($valid_till)?'null':(is_int($valid_till)?'"'.date('Y-m-d H:i:s',$valid_till).'"':'"'.$this->connectors->db->escape($valid_till).'"')).',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
			where `id`='.$id.'
		');
		$this->connectors->db->query('
			update `_users-emails`
			set `sort`=`sort`+1
			where `_user`='.$user.' and `sort`>=@sort and `id`!='.$id.'
		');
		$this->connectors->db->commit();
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
		$this->connectors->db->transaction();
		$this->connectors->db->query('
			select @sort:=`sort`,@dep:=`_user`
			from `_users-emails`
			where `id`='.$id.'
		');
		$this->connectors->db->query('
			update `_users-emails`
			set `sort`=`sort`-1
			where `_user`=@dep and `sort`>@sort
		');
		$this->connectors->db->query('
			delete from `_users-emails` 
			where `id`='.$id.'
		');
		$this->connectors->db->query('
			delete from `_users-emails-state`
			where `_users-email`='.$id.'
		');
		$this->connectors->db->commit();
		return $id;
	}
}
<?php
namespace tessefakt\apps\tessefakt\libraries\users;
class emails extends \tessefakt\library{
	public function create(
		int $user,
		string $email,
		int $sort,
		int|string|null $valid_from=null,
	):int{
		return $this->_create(
			user:$user,
			email:$email,
			sort:$sort,
			valid_from:$valid_from,
		);
	}
	protected function _create(
		int $user,
		string $email,
		int $sort,
		int|string|null $valid_from,
	):int{
		$this->connectors->db->transaction();
		$this->connectors->db->query('
			select @sort:=least(greatest('.$sort.',0),ifnull(`reflection`.`count`,1))
			from `_users`
			left join (
				select
					`_user`,
					count(*) `count`
				from `_user-emails` `reflection`
				group by `_user`
			) `reflection` on `reflection`.`_user`=`_users`.`id`
			where `_users`.`id`='.$user.'
		');
		$this->connectors->db->query('
			insert into `_user-emails` 
			set 
				`_user`='.$user.',
				`email`="'.$this->connectors->db->escape($email).'",
				`sort`=@sort,
				`valid_from`='.(is_null($valid_from)?'curdate()':(is_int($valid_from)?'"'.date('Y-m-d H:i:s',$valid_from).'"':'"'.$this->connectors->db->escape($valid_from).'"')).'
		');
		$iId=$this->connectors->db->insert();
		$this->connectors->db->query('
			update `_user-emails`
			set `sort`=`sort`+1
			where
				`_user`='.$user.' and
				`sort`>=@sort and
				`id`!='.$iId.'
		');
		$this->connectors->db->query('
			insert into `_user-email-state`
			set
				`_user-email`='.$iId.',
				`state`="waiting",
				`timestamp`=now(),
				`remark`=null,
				`key`="'.$this->key->create().'"
		');
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
			from `_app-cm_rights`
			where '.(is_null($where)||!count($where)?'1':implode(' and ',array_recombine($where,function($key,$value){ return '`'.$key.'`='.(is_null($value)?'null':'"'.$this->connectors->db->escape($value).'"'); }))).'
			'.(is_null($order)||!count($order)?'':'order '.implode(',',array_recombine($order,function($key,$value){ return '`'.$key.'` '.(is_null($value)?'asc':$value); }))).'
			'.(is_null($limit)||!count($limit)?'':implode(' ',array_filter([(isset($limit['offset'])?'offset '.$limit['offset']:''),(isset($limit['fetch'])?' fetch '.$limit['fetch']:'')],'strlen'))).'
		');
	}
	public function update(
		int $id,
		int $user,
		string $email,
		int $sort,
		int|string|null $valid_from=null,
	):int{
		return $this->_update(
			id:$id,
			user:$user,
			email:$email,
			sort:$sort,
			valid_from:$valid_from,
		);
	}
	protected function _update(
		int $id,
		int $user,
		string $email,
		int $sort,
		int|string|null $valid_from,
	):int{
		$this->connectors->db->transaction();
		$this->connectors->db->query('
			select 
				@sort:=`sort`,
				@dependency:=`_user`
			from `_user-emails`
			where `id`='.$id.'
		');
		$this->connectors->db->query('
			update `_user-emails`
			set `sort`=`sort`-1
			where
				`_user`=@dependency and
				`sort`>@sort
		');
		$this->connectors->db->query('
			select @sort:=least(greatest('.$sort.',0),ifnull(`reflection`.`count`,1)-if(`reflection`.`_user`='.$user.',1,0))
			from `_users`
			left join (
				select
					`_user`,
					count(*) `count`
				from `_user-emails` `reflection`
				group by `_user`
			) `reflection` on `reflection`.`_user`=`_users`.`id`
			where `_users`.`id`='.$user.'
		');
		$this->connectors->db->query('
			update `_user-emails` 
			set 
				`_user`='.$user.',
				`email`="'.$this->connectors->db->escape($email).'",
				`order`='.$sort.',
				`valid_from`='.(is_null($valid_from)?'curdate()':(is_int($valid_from)?'"'.date('Y-m-d H:i:s',$valid_from).'"':'"'.$this->connectors->db->escape($valid_from).'"')).'
			where `id`='.$id.'
		');
		$this->connectors->db->query('
			update `_user_emails`
			set `sort`=`sort`+1
			where
				`_user`='.$user.' and
				`sort`>=@sort and
				`id`!='.$iId.'
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
			select 
				@sort:=`sort`,
				@dependency:=`_user`
			from `user_emails`
			where `id`='.$id.'
		');
		$this->connectors->db->query('
			update `_user-emails`
			set `sort`=`sort`-1
			where
				`_user`=@dependency and
				`sort`>@sort
		');
		$this->connectors->db->query('
			delete `_user-emails` 
			where `id`='.$id.'
		');
		return $id;
	}
}
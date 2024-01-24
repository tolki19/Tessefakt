<?php
namespace tessefakt\apps\tessefakt\libraries;
class errors extends \tessefakt\library{
	public function create(
		string $error,
		int|string|null $user=null,
		int|null $timestamp=null,
		string|null $remark=null
	):int{
		return $this->_create(
			error:$error,
			user:$user,
			timestamp:$timestamp,
			remark:$remark
		);
	}
	protected function _create(
		string $error,
		int|string|null $user=null,
		int|null $timestamp=null,
		string|null $remark=null
	):int{
		$this->connectors->db->query('
			insert into `_errors`
			set 
				`__user`='.(is_null($user)?'null':'"'.$this->connectors->db->escape($user).'"').',
				`timestamp`='.(is_null($timestamp)?'now()':'"'.$this->connectors->db->escape($timestamp).'"').',
				`error`="'.$this->connectors->db->escape($error).'",
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
			from `_errors`
			where '.(is_null($where)||!count($where)?'1':implode(' and ',array_recombine($where,function($key,$value){ return '`'.$key.'`='.(is_null($value)?'null':'"'.$this->connectors->db->escape($value).'"'); }))).'
			'.(is_null($order)||!count($order)?'':'order by '.implode(',',$order)).'
			'.(is_null($limit)||!count($limit)?'':implode(' ',array_filter([(isset($limit['offset'])?'offset '.$limit['offset']:''),(isset($limit['fetch'])?' fetch '.$limit['fetch']:'')],'strlen'))).'
		');
	}
	public function update(
		int $id,
		string $error,
		int|string|null $user=null,
		int|null $timestamp=null,
		string|null $remark=null
	):int{
		return $this->_update(
			id:$id,
			error:$error,
			user:$user,
			timestamp:$timestamp,
			remark:$remark
		);
	}
	protected function _update(
		int $id,
		string $error,
		int|string|null $user=null,
		int|null $timestamp=null,
		string|null $remark=null
	):int{
		$this->connectors->db->query('
			update `_errors`
			set 
				`__user`='.(is_null($user)?'null':'"'.$this->connectors->db->escape($user).'"').',
				`timestamp`='.(is_null($timestamp)?'now()':'"'.$this->connectors->db->escape($timestamp).'"').',
				`error`="'.$this->connectors->db->escape($error).'",
				`remark`='.(is_null($remark)?'null':'"'.$this->connectors->db->escape($remark).'"').'
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
			delete from `_errors`
			where `id`='.$id.'
		');
		return $id;
	}
}
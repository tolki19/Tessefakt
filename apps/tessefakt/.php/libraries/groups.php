<?php
namespace tessefakt\apps\tessefakt\libraries;
class groups extends \tessefakt\library{
	public function create(
		string $name,
		string|null $internal_remark=null,
	):int{
		return $this->_create(
			name:$name,
			internal_remark:$internal_remark,
		);
	}
	protected function _create(
		string $name,
		string|null $internal_remark,
	):int{
		$this->connectors->db->query('
			insert into `_groups`
			set 
			`name`="'.$this->connectors->db->escape($name).'",
			`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		return $this->connectors->db->insert();
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
			from `_groups`
			where '.(is_null($where)||!count($where)?'1':implode(' and ',array_recombine($where,function($key,$value){ return '`'.$key.'`='.(is_null($value)?'null':'"'.$this->connectors->db->escape($value).'"'); }))).'
			'.(is_null($order)||!count($order)?'':'order by '.implode(',',$order)).'
			'.(is_null($limit)||!count($limit)?'':implode(' ',array_filter([(isset($limit['offset'])?'offset '.$limit['offset']:''),(isset($limit['fetch'])?' fetch '.$limit['fetch']:'')],'strlen'))).'
		');
	}
	public function update(
		int $id,
		string $name,
		string|null $internal_remark=null,
	):int{
		return $this->_update(
			id:$id,
			name:$name,
			internal_remark:$internal_remark,
		);
	}
	protected function _update(
		int $id,
		string $name,
		string|null $internal_remark,
	):int{
		$this->connectors->db->query('
			update `_groups`
			set 
				`name`="'.$this->connectors->db->escape($name).'",
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
			where `id`='.$id.'
		');
		return $this->connectors->db->insert();
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
		delete from `_groups`
		where `id`='.$id.'
		');
		return $this->connectors->db->insert();
	}
}
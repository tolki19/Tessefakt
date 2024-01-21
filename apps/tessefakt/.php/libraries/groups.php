<?php
namespace tessefakt\apps\tessefakt\libraries;
class groups extends \tessefakt\library{
	public function create(
		string $name
	):int{
		return $this->_create(
			name:$name
		);
	}
	protected function _create(
		string $name
	):int{
		$this->connectors->db->query('
			insert into `_groups`
			set 
				`name`="'.$this->connectors->db->escape($name).'"
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
			'.(is_null($order)||!count($order)?'':'order '.implode(',',array_recombine($order,function($key,$value){ return '`'.$key.'` '.(is_null($value)?'asc':$value); }))).'
			'.(is_null($limit)||!count($limit)?'':implode(' ',array_filter([(isset($limit['offset'])?'offset '.$limit['offset']:''),(isset($limit['fetch'])?' fetch '.$limit['fetch']:'')],'strlen'))).'
		');
	}
	public function update(
		int $id,
		string $name
	):int{
		return $this->_update(
			id:$id,
			name:$name
		);
	}
	protected function _update(
		int $id,
		string $name
	):int{
		$this->connectors->db->query('
			update `_groups`
			set 
				`name`="'.$this->connectors->db->escape($name).'"
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
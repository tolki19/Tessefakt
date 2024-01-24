<?php
namespace tessefakt\apps\hebaz\libraries\events;
class dates extends \tessefakt\library{
	public function create(
		int $event,
		int|string $from,
		int|string $till,
		string|null $public_remark=null,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			event:$event,
			from:$from,
			till:$till,
			public_remark:$public_remark,
			internal_remark:$internal_remark,
		);
	}
	protected function _create(
		int $event,
		int|string $from,
		int|string $till,
		string|null $public_remark,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			insert into `events-dates`
			set
				`event`='.$event.',
				`from`='.(is_int($from)?'"'.date('Y-m-d H:i:s',$from).'"':'"'.$this->connectors->db->escape($from).'"').',
				`till`='.(is_int($till)?'"'.date('Y-m-d H:i:s',$till).'"':'"'.$this->connectors->db->escape($till).'"').',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
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
			from `events-dates`
			where '.(is_null($where)||!count($where)?'1':implode(' and ',array_recombine($where,function($key,$value){ return '`'.$key.'`='.(is_null($value)?'null':'"'.$this->connectors->db->escape($value).'"'); }))).'
			'.(is_null($order)||!count($order)?'':'order '.implode(',',$order)).'
			'.(is_null($limit)||!count($limit)?'':implode(' ',array_filter([(isset($limit['offset'])?'offset '.$limit['offset']:''),(isset($limit['fetch'])?' fetch '.$limit['fetch']:'')],'strlen'))).'
		');
	}
	public function update(
		int $id,
		int $event,
		int|string $from,
		int|string $till,
		string|null $public_remark=null,
		string|null $internal_remark=null
	):int{
		return $this->_update(
			id:$id,
			event:$event,
			from:$from,
			till:$till,
			public_remark:$public_remark,
			internal_remark:$internal_remark,
		);
	}
	protected function _update(
		int $id,
		int $event,
		int|string $from,
		int|string $till,
		string|null $public_remark,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			update `events-dates`
			set
				`event`='.$event.',
				`from`='.(is_int($from)?'"'.date('Y-m-d H:i:s',$from).'"':'"'.$this->connectors->db->escape($from).'"').',
				`till`='.(is_int($till)?'"'.date('Y-m-d H:i:s',$till).'"':'"'.$this->connectors->db->escape($till).'"').',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
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
			delete from `events-dates`
			where `id`='.$id.'
		');
		return $id;
	}
}
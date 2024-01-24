<?php
namespace tessefakt\apps\hebaz\libraries\midwives;
class states extends \tessefakt\library{
	public function create(
		int $midwife,
		string $state,
		int|string|null $from=null,
		int|string|null $till=null,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			midwife:$midwife,
			state:$state,
			from:$from,
			till:$till,
			internal_remark:$internal_remark
		);
	}
	protected function _create(
		int $midwife,
		string $state,
		int|string|null $from,
		int|string|null $till,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			insert into `midwives-states`
			set
				`midwife`='.$midwife.',
				`state`="'.$this->connectors->db->escape($state).'",
				`from`='.(is_null($from)?'null':(is_int($from)?'"'.date('Y-m-d H:i:s').'"':'"'.$this->connectors->db->escape($from).'"')).',
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
			from `midwives-states`
			where '.(is_null($where)||!count($where)?'1':implode(' and ',array_recombine($where,function($key,$value){ return '`'.$key.'`='.(is_null($value)?'null':'"'.$this->connectors->db->escape($value).'"'); }))).'
			'.(is_null($order)||!count($order)?'':'order '.implode(',',$order)).'
			'.(is_null($limit)||!count($limit)?'':implode(' ',array_filter([(isset($limit['offset'])?'offset '.$limit['offset']:''),(isset($limit['fetch'])?' fetch '.$limit['fetch']:'')],'strlen'))).'
		');
	}
	public function update(
		int $id,
		int $midwife,
		string $state,
		int|string|null $from=null,
		int|string|null $till=null,
		string|null $internal_remark=null
	):int{
		return $this->_update(
			id:$id,
			midwife:$midwife,
			state:$state,
			from:$from,
			till:$till,
			internal_remark:$internal_remark
		);
	}
	protected function _update(
		int $id,
		int $midwife,
		string $state,
		int|string|null $from,
		int|string|null $till,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			update `midwives-states`
			set
				`midwife`='.$midwife.',
				`state`="'.$this->connectors->db->escape($state).'",
				`from`='.(is_null($from)?'null':(is_int($from)?'"'.date('Y-m-d H:i:s').'"':'"'.$this->connectors->db->escape($from).'"')).',
				`till`='.(is_null($till)?'null':(is_int($till)?'"'.date('Y-m-d H:i:s').'"':'"'.$this->connectors->db->escape($till).'"')).',
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
			delete from `midwives-states`
			where `id`='.$id.'
		');
		return $id;
	}
}
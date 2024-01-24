<?php
namespace tessefakt\apps\hebaz\libraries\applications;
class midwives extends \tessefakt\library{
	public function create(
		int $application,
		int $midwife,
		int|string $bid_date,
		int|string $award_date,
		string|null $public_remark=null,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			application:$application,
			midwife:$midwife,
			bid_date:$bid_date,
			award_date:$award_date,
			public_remark:$public_remark,
			internal_remark:$internal_remark
		);
	}
	protected function _create(
		int $application,
		int $midwife,
		int|string $bid_date,
		int|string $award_date,
		string|null $public_remark,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			insert into `applications-midwives`
			set
				`application`='.$application.',
				`midwife`='.$midwife.',
				`bid-date`='.(is_int($bid_date)?'"'.date('Y-m-d H:i:s',$bid_date).'"':'"'.$this->connectors->db->escape($bid_date).'"').',
				`award-date`='.(is_int($award_date)?'"'.date('Y-m-d H:i:s',$award_date).'"':'"'.$this->connectors->db->escape($award_date).'"').',
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
			from `applications-midwives`
			where '.(is_null($where)||!count($where)?'1':implode(' and ',array_recombine($where,function($key,$value){ return '`'.$key.'`='.(is_null($value)?'null':'"'.$this->connectors->db->escape($value).'"'); }))).'
			'.(is_null($order)||!count($order)?'':'order by '.implode(',',$order)).'
			'.(is_null($limit)||!count($limit)?'':implode(' ',array_filter([(isset($limit['offset'])?'offset '.$limit['offset']:''),(isset($limit['fetch'])?' fetch '.$limit['fetch']:'')],'strlen'))).'
		');
	}
	public function update(
		int $id,
		int $application,
		int $midwife,
		int|string $bid_date,
		int|string $award_date,
		string|null $public_remark=null,
		string|null $internal_remark=null
	):int{
		return $this->_update(
			id:$id,
			application:$application,
			midwife:$midwife,
			bid_date:$bid_date,
			award_date:$award_date,
			public_remark:$public_remark,
			internal_remark:$internal_remark
		);
	}
	protected function _update(
		int $id,
		int $application,
		int $midwife,
		int|string $bid_date,
		int|string $award_date,
		string|null $public_remark,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			update `applications-midwives`
			set
				`application`='.$application.',
				`midwife`='.$midwife.',
				`bid-date`='.(is_int($bid_date)?'"'.date('Y-m-d H:i:s',$bid_date).'"':'"'.$this->connectors->db->escape($bid_date).'"').',
				`award-date`='.(is_int($award_date)?'"'.date('Y-m-d H:i:s',$award_date).'"':'"'.$this->connectors->db->escape($award_date).'"').',
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
			delete from `applications-midwives`
			where `id`='.$id.'
		');
		return $id;
	}
}
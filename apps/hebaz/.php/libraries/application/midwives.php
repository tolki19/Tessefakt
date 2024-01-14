<?php
namespace tessefakt\apps\hebaz\libraries\application;
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
			insert into `application-midwives`
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
			update `application-midwives`
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
}
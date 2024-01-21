<?php
namespace tessefakt\apps\hebaz\libraries\midwives;
class cds extends \tessefakt\library{
	public function create(
		int $midwife,
		int $cd,
		int $sort,
		string $date,
		int|string|null $from=null,
		int|string|null $till=null,
		string|null $public_remark=null,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			midwife:$midwife,
			cd:$cd,
			sort:$sort,
			date:$date,
			from:$from,
			till:$till,
			public_remark:$public_remark,
			internal_remark:$internal_remark
		);
	}
	protected function _create(
		int $midwife,
		int $cd,
		int $sort,
		string $date,
		int|string|null $from,
		int|string|null $till,
		string|null $public_remark,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			insert into `midwives-cds`
			set
				`midwife`='.$midwife.',
				`cd`='.$cd.',
				`sort`='.$sort.',
				`date`="'.$this->connectors->db->escape($date).'",
				`from`='.(is_null($from)?'null':(is_int($from)?'"'.date('Y-m-d H:i:s',$from).'"':'"'.$this->connectors->db->escape($from).'"')).',
				`till`='.(is_null($till)?'null':(is_int($till)?'"'.date('Y-m-d H:i:s',$till).'"':'"'.$this->connectors->db->escape($till).'"')).',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
	public function update(
		int $id,
		int $midwife,
		int $cd,
		int $sort,
		string $date,
		int|string|null $from=null,
		int|string|null $till=null,
		string|null $public_remark=null,
		string|null $internal_remark=null
	):int{
		return $this->_update(
			id:$id,
			midwife:$midwife,
			cd:$cd,
			sort:$sort,
			date:$date,
			from:$from,
			till:$till,
			public_remark:$public_remark,
			internal_remark:$internal_remark
		);
	}
	protected function _update(
		int $id,
		int $midwife,
		int $cd,
		int $sort,
		string $date,
		int|string|null $from,
		int|string|null $till,
		string|null $public_remark,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			update `midwives-cds`
			set
				`midwife`='.$midwife.',
				`cd`='.$cd.',
				`sort`='.$sort.',
				`date`="'.$this->connectors->db->escape($date).'",
				`from`='.(is_null($from)?'null':(is_int($from)?'"'.date('Y-m-d H:i:s',$from).'"':'"'.$this->connectors->db->escape($from).'"')).',
				`till`='.(is_null($till)?'null':(is_int($till)?'"'.date('Y-m-d H:i:s',$till).'"':'"'.$this->connectors->db->escape($till).'"')).',
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
			delete from `midwives-cds`
			where `id`='.$id.'
		');
		return $id;
	}
}
<?php
namespace tessefakt\apps\hebaz\libraries\event;
class midwives extends \tessefakt\library{
	public function create(
		int $event,
		int $midwife,
		string|null $public_remark=null,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			event:$event,
			midwife:$midwife,
			public_remark:$public_remark,
			internal_remark:$internal_remark,
		);
	}
	protected function _create(
		int $event,
		int $midwife,
		string|null $public_remark,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			insert into `event-midwives`
			set
				`event`='.$event.',
				`midwife`='.$midwife.',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
	public function update(
		int $id,
		int $event,
		int $midwife,
		string|null $public_remark=null,
		string|null $internal_remark=null
	):int{
		return $this->_update(
			id:$id,
			event:$event,
			midwife:$midwife,
			public_remark:$public_remark,
			internal_remark:$internal_remark,
		);
	}
	protected function _update(
		int $id,
		int $event,
		int $midwife,
		string|null $public_remark,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			update `event-midwives`
			set
				`event`='.$event.',
				`midwife`='.$midwife.',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
			where `id`='.$id.'
		');
		return $id;
	}
}
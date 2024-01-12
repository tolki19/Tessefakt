<?php
namespace tessefakt\apps\hebaz\libraries\event;
class dates extends \tessefakt\library{
	public function create(
		int $event,
		int|string $datetime,
		string|null $public_remark=null,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			$event,
			datetime:$datetime,
			public_remark:$public_remark,
			internal_remark:$internal_remark,
		);
	}
	protected function _create(int $event,int|string $datetime,string|null $public_remark,string|null $internal_remark):int{
		$this->connectors->db->query('
			insert into `event-dates`
			set
				`event`='.$event.',
				`datetime`='.(is_int($datetime)?'"'.date('Y-m-d H:i:s',$datetime).'"':'"'.$this->connectors->db->escape($datetime).'"').',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
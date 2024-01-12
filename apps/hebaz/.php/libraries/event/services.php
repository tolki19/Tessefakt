<?php
namespace tessefakt\apps\hebaz\libraries\event;
class services extends \tessefakt\library{
	public function create(
		int $event,
		int $service,
		string|null $public_remark=null,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			$event,
			service:$service,
			public_remark:$public_remark,
			internal_remark:$internal_remark
		);
	}
	protected function _create(int $event,):int{
		$this->connectors->db->query('
			insert into ``
			set
				`event`='.$event.',
				`service`='.$service.',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
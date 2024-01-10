<?php
namespace tessefakt\apps\hebaz\libraries\event;
class services extends \tessefakt\library{
	public function create(int $event,array $data):int{
		return $this->_create(
			$event,
			$data['service'],
			$data['public-remark'],
			$data['internal-remark']
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
<?php
namespace tessefakt\apps\hebaz\libraries\event;
class cds extends \tessefakt\library{
	public function create(int $event,array $data):int{
		return $this->_create(
			$event,
			$data['cd'],
			$data['date'],
			$data['public-remark']??null,
			$data['internal-remark']??null
		);
	}
	protected function _create(int $event,int $cd, string $date,string|null $public_remark,string $internal_remark):int{
		$this->connectors->db->query('
			insert into `event-cds`
			set
				`event`='.$event.',
				`cd`='.$cd.',
				`date`="'.$this->connectors->db->escape($date).'",
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').',
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
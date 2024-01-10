<?php
namespace tessefakt\apps\hebaz\libraries\event;
class states extends \tessefakt\library{
	public function create(int $event,array $data):int{
		return $this->_create(
			$event,
			$data['state'],
			$data['from']??null,
			$data['till']??null,
			$data['internal-remark']??null
		);
	}
	protected function _create(int $event,string $state,int|string|null $from,int|string|null $till,string|null $internal_remark):int{
		$this->connectors->db->query('
			insert into `event-states`
			set
				`event`='.$event.',
				`state`="'.$this->connectors->db->escape($state).'",
				`from`='.(is_null($from)?'null':(is_int($from)?'"'.date('Y-m-d H:i:s',$from).'"':'"'.$this->connectors->db->escape($from).'"')).',
				`till`='.(is_null($till)?'null':(is_int($till)?'"'.date('Y-m-d H:i:s',$till).'"':'"'.$this->connectors->db->escape($till).'"')).',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
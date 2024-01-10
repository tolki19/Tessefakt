<?php
namespace tessefakt\apps\hebaz\libraries\application;
class states extends \tessefakt\library{
	public function create(int $application,array $data):int{
		return $this->_create(
			$application,
			$data['state'],
			$data['from']??null,
			$data['till']??null,
			$data['internal-remark']??null
		);
	}
	protected function _create(int $application,string $state,int|string|null $from,int|string|null $till,string|null $internal_remark):int{
		$this->connectors->db->query('
			insert into `application-states`
			set
				`application`='.$application.',
				`state`="'.$this->connectors->db->escape($state).'",
				`from`='.(is_null($from)?'null':(is_int($from)?'"'.date('Y-m-d H:i:s',$from).'"':'"'.$this->connectors->db->escape($from).'"')).',
				`till`='.(is_null($till)?'null':(is_int($till)?'"'.date('Y-m-d H:i:s',$till).'"':'"'.$this->connectors->db->escape($till).'"')).',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
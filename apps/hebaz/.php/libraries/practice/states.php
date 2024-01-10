<?php
namespace tessefakt\apps\hebaz\libraries\practice;
class states extends \tessefakt\library{
	public function create(int $practice,array $data):int{
		return $this->_create(
			$practice,
			$data['state'],
			$data['from']??null,
			$data['till']??null,
		);
	}
	protected function _create(int $practice,string $state,int|string|null $from,int|string|null $till):int{
		$this->connectors->db->query('
			insert into `practice-states`
			set
				`practice`='.$practice.',
				`state`="'.$this->connectors->db->escape($state).'",
				`from`='.(is_null($from)?'null':(is_int($from)?'"'.date('Y-m-d H:i:s',$from).'"':'"'.$this->connectors->db->escape($from).'"')).',
				`till`='.(is_null($till)?'null':(is_int($till)?'"'.date('Y-m-d H:i:s',$till).'"':'"'.$this->connectors->db->escape($till).'"')).',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
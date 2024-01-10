<?php
namespace tessefakt\apps\hebaz\libraries\midwife;
class states extends \tessefakt\library{
	public function create(int $midwife,array $data):int{
		return $this->_create(
			$midwife,
			$data['state'],
			$data['from']??null,
			$data['till']??null,
			$data['internal-remark']??null
		);
	}
	protected function _create(int $midwife,string $state,int|string|null $from,int|string|null $till,string|null $internal_remark):int{
		$this->connectors->db->query('
			insert into `midwife-states`
			set
				`midwife`='.$midwife.',
				`state`="'.$this->connectors->db->escape($state).'",
				`from`='.(is_null($from)?'null':(is_int($from)?'"'.date('Y-m-d H:i:s').'"':'"'.$this->connectors->db->escape($from).'"')).',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
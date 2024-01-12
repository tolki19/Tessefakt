<?php
namespace tessefakt\apps\hebaz\libraries\practice;
class states extends \tessefakt\library{
	public function create(
		int $practice,
		string $state,
		int|string|null $from=null,
		int|string|null $till=null,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			$practice,
			state:$state,
			from:$from,
			till:$till,
			internal_remark:$internal_remark
		);
	}
	protected function _create(int $practice,string $state,int|string|null $from,int|string|null $till,string|null $internal_remark):int{
		$this->connectors->db->query('
			insert into `practice-states`
			set
				`practice`='.$practice.',
				`state`="'.$this->connectors->db->escape($state).'",
				`from`='.(is_null($from)?'null':(is_int($from)?'"'.date('Y-m-d H:i:s',$from).'"':'"'.$this->connectors->db->escape($from).'"')).',
				`till`='.(is_null($till)?'null':(is_int($till)?'"'.date('Y-m-d H:i:s',$till).'"':'"'.$this->connectors->db->escape($till).'"')).',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
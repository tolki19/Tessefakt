<?php
namespace tessefakt\apps\hebaz\libraries\midwife;
class occupancies extends \tessefakt\library{
	public function create(
		int $midwife,
		int|string $from,
		int|string|null $till=null,
		string|null $public_remark=null,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			$midwife,
			from:$from,
			till:$till,
			public_remark:$public_remark,
			internal_remark:$internal_remark
		);
	}
	protected function _create(int $midwife,int|string $from,int|string|null $till,string|null $public_remark,string|null $internal_remark):int{
		$this->connectors->db->query('
			insert into `midwife-occupancies`
			set
				`midwife`='.$midwife.',
				`from`='.(is_int($from)?'"'.date('Y-m-d H:i:s',$from).'"':'"'.$this->connectors->db->escape($from).'"').',
				`till`='.(is_null($till)?'null':(is_int($till)?'"'.date('Y-m-d H:i:s',$till).'"':'"'.$this->connectors->db->escape($till).'"')).',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
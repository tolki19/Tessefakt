<?php
namespace tessefakt\apps\hebaz\libraries\midwife;
class cds extends \tessefakt\library{
	public function create(int $midwife,array $data):int{
		return $this->_create(
			$midwife,
			$data['cd'],
			$data['date'],
			$data['public-remark']??null,
			$data['internal-remark']??null
		);
	}
	protected function _create(int $midwife,int $cd,string $date,string|null $public_remark,string|null $internal_remark):int{
		$this->connectors->db->query('
			insert into `midwife-cds`
			set
				`midwife`='.$midwife.',
				`cd`='.$cd.',
				`date`="'.$this->connectors->db->escape($date).'",
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
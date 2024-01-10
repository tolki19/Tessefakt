<?php
namespace tessefakt\apps\hebaz\libraries\practice;
class cds extends \tessefakt\library{
	public function create(int $practice,array $data):int{
		return $this->_create(
			$practice,
			$data['cd'],
			$data['date'],
			$data['public-remark']??null,
			$data['internal-remark']??null
		);
	}
	protected function _create(int $practice,int $cd,string $date,string|null $public_remark,string|null $internal_remark):int{
		$this->connectors->db->query('
			insert into `practice-cds`
			set
				`practice`='.$practice.',
				`cd`='.$cd.',
				`date`="'.$this->connectors->db->escape($date).'",
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
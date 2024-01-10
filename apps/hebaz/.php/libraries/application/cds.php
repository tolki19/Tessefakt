<?php
namespace tessefakt\apps\hebaz\libraries\application;
class cds extends \tessefakt\library{
	public function create(int $application,array $data):int{
		return $this->_create(
			$application,
			$data['cd'],
			$data['sort'],
			$data['date'],
			$data['from']??null,
			$data['till']??null,
			$data['public-remark']??null,
			$data['internal-remark']??null
		);
	}
	protected function _create(int $application,int $cd,int $sort,int|string $date,int|string|null $from,int|string|null $till,string|null $public_remark,string|null $internal_remark):int{
		$this->connectors->db->query('
			insert into `application-cds`
			set
				`application`='.$application.',
				`cd`='.$cd.',
				`sort`='.$sort.',
				`date`="'.$this->connectors->db->escape($date).'",
				`from`='.(is_null($from)?'null':(is_int($from)?'"'.date('Y-m-d H:i:s',$from).'"':'"'.$this->connectors->db->escape($from).'"')).',
				`till`='.(is_null($till)?'null':(is_int($till)?'"'.date('Y-m-d H:i:s',$till).'"':'"'.$this->connectors->db->escape($till).'"')).',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
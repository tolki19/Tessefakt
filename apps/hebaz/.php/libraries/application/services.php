<?php
namespace tessefakt\apps\hebaz\libraries\application;
class services extends \tessefakt\library{
	public function create(
		int $application,
		int $service,
		string|null $public_remark=null,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			$application,
			service:$service,
			public_remark:$public_remark,
			internal_remark:$internal_remark
		);
	}
	protected function _create(int $application,int $service,string|null $public_remark,string|null $internal_remark):int{
		$this->connectors->db->query('
			insert into `application-services`
			set
				`application`='.$application.',
				`service`='.$service.',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
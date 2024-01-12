<?php
namespace tessefakt\apps\hebaz\libraries\midwife;
class languages extends \tessefakt\library{
	public function create(
		int $midwife,
		int $language,
		string|null $public_remark=null,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			$midwife,
			language:$language,
			public_remark:$public_remark,
			internal_remark:$internal_remark
		);
	}
	protected function _create(int $midwife,int $language,string|null $public_remark,string|null $internal_remark):int{
		$this->connectors->db->query('
			insert into `midwife-languages`
			set
				`midwife`='.$midwife.',
				`language`='.$language.',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
<?php
namespace tessefakt\apps\hebaz\libraries;
class navigations extends \tessefakt\library{
	public function create(
		string $keystring,
		string|null $internal_caption=null,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			keystring:$keystring,
			internal_caption:$internal_caption,
			internal_remark:$internal_remark
		);
	}
	protected function _create(
		string $keystring,
		string|null $internal_caption,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			insert into `navigations`
			set
				`keystring`="'.$this->connectors->db->escape($keystring).'",
				`internal-caption`='.(is_null($internal_caption)?'null':'"'.$this->connectors->db->escape($internal_caption).'"').'
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
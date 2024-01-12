<?php
namespace tessefakt\apps\hebaz\libraries;
class pages extends \tessefakt\library{
	public function create(
		string $title,
		string|null $internal_caption=null,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			title:$title,
			internal_caption:$internal_caption,
			internal_remark:$internal_remark
		);
	}
	protected function _create(
		string $title,
		string|null $internal_caption,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			insert into `pages`
			set
				`title`="'.$this->connectors->db->escape($title).'",
				`internal-caption`='.(is_null($internal_caption)?'null':'"'.$this->connectors->db->escape($internal_caption).'"').'
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
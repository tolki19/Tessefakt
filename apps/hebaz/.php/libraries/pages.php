<?php
namespace tessefakt\apps\hebaz\libraries;
class pages extends \tessefakt\library{
	public function create(array $data):int{
		return $this->_create(
			$data['title'],
			$data['internal-caption']??null,
			$data['internal-remark']??null
		);
	}
	protected function _create(string $title,string|null $internal_caption,string|null $internal_remark):int{
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
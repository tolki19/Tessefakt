<?php
namespace tessefakt\apps\hebaz\libraries;
class statics extends \tessefakt\library{
	public function create(array $data):int{
		return $this->_create(
			$data['content'],
			$data['internal-caption'],
			$data['internal-remark']??null
		);
	}
	protected function _create(string $keystring,string $content,string $internal_caption,string|null $internal_remark):int{
		$this->connectors->db->query('
			insert into ``
			set
				`content`="'.$this->connectors->db->escape($content).'",
				`internal-caption`="'.$this->connectors->db->escape($internal_caption).'",
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
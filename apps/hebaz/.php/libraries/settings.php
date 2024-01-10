<?php
namespace tessefakt\apps\hebaz\libraries;
class settings extends \tessefakt\library{
	public function create(array $data):int{
		return $this->_create(
			$data['keystring'],
			$data['date']??null,
			$data['internal-caption']??null,
			$data['internal-remark']??null
		);
	}
	protected function _create(string $keystring,string|null $date,string|null $internal_caption,string|null $internal_remark):int{
		$this->connectors->db->query('
			insert into `settings`
			set
				`keystring`="'.$this->connectors->db->escape($keystring).'",
				`date`='.(is_null($date)?'null':'"'.$this->connectors->db->escape($date).'"').'
				`internal-caption`='.(is_null($internal_caption)?'null':'"'.$this->connectors->db->escape($internal_caption).'"').'
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
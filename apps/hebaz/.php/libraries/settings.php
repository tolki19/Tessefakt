<?php
namespace tessefakt\apps\hebaz\libraries;
class settings extends \tessefakt\library{
	public function create(
		string $keystring,
		string|null $date=null,
		string|null $internal_caption=null,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			keystring:$keystring,
			date:$date,
			internal_caption:$internal_caption,
			internal_remark:$internal_remark
		);
	}
	protected function _create(
		string $keystring,
		string|null $date,
		string|null $internal_caption,
		string|null $internal_remark
	):int{
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
	public function update(
		int $id,
		string $keystring,
		string|null $date=null,
		string|null $internal_caption=null,
		string|null $internal_remark=null
	):int{
		return $this->_update(
			id:$id,
			keystring:$keystring,
			date:$date,
			internal_caption:$internal_caption,
			internal_remark:$internal_remark
		);
	}
	protected function _update(
		int $id,
		string $keystring,
		string|null $date,
		string|null $internal_caption,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			update `settings`
			set
				`keystring`="'.$this->connectors->db->escape($keystring).'",
				`date`='.(is_null($date)?'null':'"'.$this->connectors->db->escape($date).'"').'
				`internal-caption`='.(is_null($internal_caption)?'null':'"'.$this->connectors->db->escape($internal_caption).'"').'
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
			where `id`='.$id.'
		');
		return $id;
	}
}
<?php
namespace tessefakt\apps\hebaz\libraries\midwives;
class languages extends \tessefakt\library{
	public function create(
		int $midwife,
		int $language,
		string|null $public_remark=null,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			midwife:$midwife,
			language:$language,
			public_remark:$public_remark,
			internal_remark:$internal_remark
		);
	}
	protected function _create(
		int $midwife,
		int $language,
		string|null $public_remark,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			insert into `midwives-languages`
			set
				`midwife`='.$midwife.',
				`language`='.$language.',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
	public function update(
		int $id,
		int $midwife,
		int $language,
		string|null $public_remark=null,
		string|null $internal_remark=null
	):int{
		return $this->_update(
			id:$id,
			midwife:$midwife,
			language:$language,
			public_remark:$public_remark,
			internal_remark:$internal_remark
		);
	}
	protected function _update(
		int $id,
		int $midwife,
		int $language,
		string|null $public_remark,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			update `midwives-languages`
			set
				`midwife`='.$midwife.',
				`language`='.$language.',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
			where `id`='.$id.'
		');
		return $id;
	}
	public function delete(
		int $id,
	):int{
		return $this->_delete(
			id:$id,
		);
	}
	protected function _delete(
		int $id,
	):int{
		$this->connectors->db->query('
			delete from `midwives-languages`
			where `id`='.$id.'
		');
		return $id;
	}
}
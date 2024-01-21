<?php
namespace tessefakt\apps\hebaz\libraries\events;
class states extends \tessefakt\library{
	public function create(
		int $event,
		string $state,
		int|string|null $from=null,
		int|string|null $till=null,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			event:$event,
			state:$state,
			from:$from,
			till:$till,
			internal_remark:$internal_remark
		);
	}
	protected function _create(
		int $event,
		string $state,
		int|string|null $from,
		int|string|null $till,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			insert into `events-states`
			set
				`event`='.$event.',
				`state`="'.$this->connectors->db->escape($state).'",
				`from`='.(is_null($from)?'null':(is_int($from)?'"'.date('Y-m-d H:i:s',$from).'"':'"'.$this->connectors->db->escape($from).'"')).',
				`till`='.(is_null($till)?'null':(is_int($till)?'"'.date('Y-m-d H:i:s',$till).'"':'"'.$this->connectors->db->escape($till).'"')).',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
	public function update(
		int $id,
		int $event,
		string $state,
		int|string|null $from=null,
		int|string|null $till=null,
		string|null $internal_remark=null
	):int{
		return $this->_update(
			id:$id,
			event:$event,
			state:$state,
			from:$from,
			till:$till,
			internal_remark:$internal_remark
		);
	}
	protected function _update(
		int $id,
		int $event,
		string $state,
		int|string|null $from,
		int|string|null $till,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			update `events-states`
			set
				`event`='.$event.',
				`state`="'.$this->connectors->db->escape($state).'",
				`from`='.(is_null($from)?'null':(is_int($from)?'"'.date('Y-m-d H:i:s',$from).'"':'"'.$this->connectors->db->escape($from).'"')).',
				`till`='.(is_null($till)?'null':(is_int($till)?'"'.date('Y-m-d H:i:s',$till).'"':'"'.$this->connectors->db->escape($till).'"')).',
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
			delete from `events-states`
			where `id`='.$id.'
		');
		return $id;
	}
}
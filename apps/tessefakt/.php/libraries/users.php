<?php
namespace tessefakt\apps\tessefakt\libraries;
class users extends \tessefakt\library{
	public function create():int{
		$iUser=$this->_create();
		return $iUser;
	}
	protected function _create():int{
		$this->connectors->db->query('
			insert into `_users`
			set 
				`id`=default
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
	public function update(
		int $id,
	):int{
		return $this->_update(
			id:$id
		);
	}
	protected function _update(
		int $id,
	):int{
		// $this->connectors->db->query('
		// 	update `_users`
		// 	where `id`='.$id.'
		// ');
		return $id;
	}
	public function delete(
		int $id,
	):int{
		return $this->_delete(
			id:$id
		);
	}
	protected function _delete(
		int $id,
	):int{
		$this->connectors->db->query('
			delete `_users`
			where `id`='.$id.'
		');
		return $id;
	}
}
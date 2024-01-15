<?php
namespace tessefakt\apps\tessefakt\libraries\user;
class uids extends \tessefakt\library{
	public function create(
		int $user,
		string $uid
	):int{
		return $this->_create(
			user:$user,
			uid:$uid
		);
	}
	protected function _create(
		int $user,
		string $uid
	):int{
		$this->connectors->db->query('
			insert into `_user-uids`
			set 
				`_user`='.$user.',
				`uid`="'.$this->connectors->db->escape($uid).'",
				`valid_from`=curdate()
		');
		$iId=$this->connectors->db->insert();
		$this->connectors->db->query('
			insert into `_user-uid-state`
			set
				`_user-uid`='.$iId.',
				`state`="waiting",
				`timestamp`=now(),
				`remark`=null,
				`key`=null
		');
		return $iId;
	}
	public function update(
		int $id,
		int $user,
		string $uid
	):int{
		return $this->_update(
			id:$id,
			user:$user,
			uid:$uid
		);
	}
	protected function _update(
		int $id,
		int $user,
		string $uid
	):int{
		$this->connectors->db->query('
			update `_user-uids`
			set 
				`_user`='.$user.',
				`uid`="'.$this->connectors->db->escape($uid).'",
				`valid_from`=curdate()
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
			delete `_user-uids`
			where `id`='.$id.'
		');
		return $id;
	}
}
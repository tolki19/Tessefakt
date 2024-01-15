<?php
namespace tessefakt\apps\tessefakt\libraries\user;
class hashes extends \tessefakt\library{
	public function create(
		int $user,
		string $password
	):int{
		return $this->_create(
			user:$user,
			password:$password
		);
	}
	protected function _create(
		int $user,
		string $password
	):int{
		$this->connectors->db->query('
			insert into `_user-hashes` 
			set 
				`_user`='.$user.',
				`type`="bcrypt",
				`hash`="'.$this->hash->create($password).'",
				`valid_from`=curdate()
			');
		$iId=$this->connectors->db->insert();
		$this->connectors->db->query('
			insert into `_user-hash-state`
			set
				`_user-hash`='.$iId.',
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
		string $password
	):int{
		return $this->_update(
			id:$id,
			user:$user,
			password:$password
		);
	}
	protected function _update(
		int $id,
		int $user,
		string $password
	):int{
		$this->connectors->db->query('
			update `_user-hashes` 
			set 
				`_user`='.$user.',
				`type`="bcrypt",
				`hash`="'.$this->hash->create($password).'",
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
			delete `_user-hashes` 
			where `id`='.$id.'
		');
		return $id;
	}
}
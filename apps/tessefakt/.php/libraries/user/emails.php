<?php
namespace tessefakt\apps\tessefakt\libraries\user;
class emails extends \tessefakt\library{
	public function create(
		int $user,
		string $email,
		int $sort,
		int|string|null $valid_from=null,
	):int{
		return $this->_create(
			user:$user,
			email:$email,
			sort:$sort,
			valid_from:$valid_from,
		);
	}
	protected function _create(
		int $user,
		string $email,
		int $sort,
		int|string|null $valid_from,
	):int{
		$this->connectors->db->query('
			insert into `_user-emails` 
			set 
				`_user`='.$user.',
				`email`="'.$this->connectors->db->escape($email).'",
				`sort`='.$sort.',
				`valid_from`='.(is_null($valid_from)?'curdate()':(is_int($valid_from)?'"'.date('Y-m-d H:i:s',$valid_from).'"':'"'.$this->connectors->db->escape($valid_from).'"')).'
		');
		$iId=$this->connectors->db->insert();
		$this->connectors->db->query('
			insert into `_user-email-state`
			set
				`_user-email`='.$iId.',
				`state`="waiting",
				`timestamp`=now(),
				`remark`=null,
				`key`="'.$this->key->create().'"
		');
		return $iId;
	}
	public function update(
		int $id,
		int $user,
		string $email,
		int $sort,
		int|string|null $valid_from=null,
	):int{
		return $this->_update(
			id:$id,
			user:$user,
			email:$email,
			sort:$sort,
			valid_from:$valid_from,
		);
	}
	protected function _update(
		int $id,
		int $user,
		string $email,
		int $sort,
		int|string|null $valid_from,
	):int{
		$this->connectors->db->query('
			update `_user-emails` 
			set 
				`_user`='.$user.',
				`email`="'.$this->connectors->db->escape($email).'",
				`order`='.$sort.',
				`valid_from`='.(is_null($valid_from)?'curdate()':(is_int($valid_from)?'"'.date('Y-m-d H:i:s',$valid_from).'"':'"'.$this->connectors->db->escape($valid_from).'"')).'
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
			delete `_user-emails` 
			where `id`='.$id.'
		');
		return $id;
	}
}
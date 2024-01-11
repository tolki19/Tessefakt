<?php
namespace tessefakt\apps\tessefakt\libraries\user;
class emails extends \tessefakt\library{
	public function create(
		int $user,
		string $email
	):int{
		return $this->_create(
			email:$email
		);
	}
	protected function _create(
		int $user,
		string $email
	):int{
		$this->connectors->db->query('
			insert into `_user-emails` 
			set 
				`_user`='.$user.',
				`email`="'.$this->connectors->db->escape($email).'",
				`order`=0,
				`valid_from`=curdate()
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
}
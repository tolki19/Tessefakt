<?php
namespace tessefakt\apps\tessefakt\libraries\user;
class hash extends \tessefakt\library{
	public function create(int $user,array $data):int{
		return $this->_create($user,$data['password']);
	}
	protected function _create(int $user,string $password):int{
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
}
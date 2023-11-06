<?php
namespace tessefakt\apps\tessefakt\controllers;
class user_hash extends \tessefakt\controller{
	public function create(int $user,array $data):int{
		return $this->_create($user,$data['password']);
	}
	protected function _create(int $user,string $password):int{
		$this->db->current->query('
			insert into `_user-hashes` 
			set 
				`_user`='.$user.',
				`type`="bcrypt",
				`hash`="'.$this->hash->create($password).'",
				`valid_from`=curdate()
			');
		$iId=$this->db->current->insert();
		$this->db->current->query('
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
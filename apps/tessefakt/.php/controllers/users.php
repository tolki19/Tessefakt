<?php
namespace tessefakt\apps\tessefakt\controllers;
class users extends \tessefakt\controller{
	public function create(array $data):void{
		$user=$this->_create_user();
		$email=$this->_create_email($user,$data['email']);
		$uid=$this->_create_uid($user,$data['uid']);
		$hash=$this->_create_hash($user,$data['password']);
	}
	protected function _create_user():int{
		$this->dbs->current->query('
			insert into `_users`
			set 
				id=default
		');
		return $this->dbs->current->insert();
	}
	protected function _create_email(int $user,string $email):int{
		$this->dbs->current->query('
			insert into `_user-emails` 
			set 
				_user='.$user.',
				email="'.$this->dbs->current->escape($email).'",
				`order`=0,
				valid_from=curdate()
		');
		$id=$this->dbs->current->insert();
		$this->dbs->current->query('
			insert into `_user-email-state`
			set
				`_user-email`='.$id.',
				state="waiting",
				timestamp=now(),
				remark=null,
				`key`="'.$this->key->create().'"
		');
		return $id;
	}
	protected function _create_uid(int $user,string $uid):int{
		$this->dbs->current->query('
			insert into `_user-uids`
			set 
				_user='.$user.',
				uid="'.$this->dbs->current->escape($uid).'",
				valid_from=curdate()
		');
		$id=$this->dbs->current->insert();
		$this->dbs->current->query('
			insert into `_user-uid-state`
			set
				`_user-uid`='.$id.',
				state="waiting",
				timestamp=now(),
				remark=null,
				`key`=null
		');
		return $id;
	}
	protected function _create_hash(int $user,string $password):int{
		$this->dbs->current->query('
			insert into `_user-hashes` 
			set 
				_user='.$user.',
				type="bcrypt",
				hash="'.$this->hash->create($password).'",
				valid_from=curdate()
			');
		$id=$this->dbs->current->insert();
		$this->dbs->current->query('
			insert into `_user-hash-state`
			set
				`_user-hash`='.$id.',
				state="waiting",
				timestamp=now(),
				remark=null,
				`key`=null
		');
		return $id;
	}
}
<?php
namespace tessefakt\apps\tessefakt\libraries;
class users extends \tessefakt\library{
	public function create(
		string|null $email=null,
		string|null $uid=null,
		string|null $password=null
	):int{
		$iUser=$this->_create();
		$iEmail=$this->app->user_email->create(
			user:$iUser,
			email:$email
		);
		$iUid=$this->app->user_uid->create(
			user:$iUser,
			uid:$uid
		);
		$iHash=$this->app->user_hash->create(
			user:$iUser,
			password:$password
		);
	}
	protected function _create():int{
		$this->connectors->db->query('
			insert into `_users`
			set 
				`id`=default
		');
		$iId=$this->connectors->db->insert();
		foreach($groups as $iGroup){
			$this->connectors->db->query('
				insert into `_user-_group`
				set 
					`_user`='.$iId.',
					`_group`='.$iGroup.',
					`valid_from`=curdate()
			');
		}
		return $iId;
	}
}
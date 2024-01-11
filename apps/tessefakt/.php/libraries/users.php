<?php
namespace tessefakt\apps\tessefakt\libraries;
class users extends \tessefakt\library{
	public function create(array $data):int{
		$iUser=$this->_create();
		$iEmail=$this->app->user_email->create($iUser,$data['email']);
		$iUid=$this->app->user_uid->create($iUser,$data['uid']);
		$iHash=$this->app->user_hash->create($iUser,$data['password']);
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
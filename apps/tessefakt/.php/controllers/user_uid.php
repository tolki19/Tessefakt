<?php
namespace tessefakt\apps\tessefakt\controllers;
class user_uid extends \tessefakt\controller{
	public function create(int $user,array $data):int{
		return $this->_create($user,$data['uid']);
	}
	protected function _create_uid(int $user,string $uid):int{
		$this->db->current->query('
			insert into `_user-uids`
			set 
				`_user`='.$user.',
				`uid`="'.$this->db->current->escape($uid).'",
				`valid_from`=curdate()
		');
		$iId=$this->db->current->insert();
		$this->db->current->query('
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
}
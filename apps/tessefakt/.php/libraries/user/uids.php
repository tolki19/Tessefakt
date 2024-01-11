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
}
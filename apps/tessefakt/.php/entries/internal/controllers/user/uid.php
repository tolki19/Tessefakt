<?php
namespace tessefakt\apps\tessefakt\entries\internal\controllers\user;
class uid extends \tessefakt\controller{
	public function create(int $user,array $data):int{
		return $this->_create($user,$data['uid']);
	}
	protected function _create_uid(int $user,string $uid):int{
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
<?php
namespace tessefakt\apps\tessefakt\entrances\internal\controllers\user;
class email extends \tessefakt\controller{
	public function create(int $user,array $data):int{
		return $this->_create($data['email']);
	}
	protected function _create(int $user,string $email):int{
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
<?php
namespace tessefakt\apps\tessefakt\libraries\user;
class groups extends \tessefakt\library{
	public function create(int $user,int $group,array $data):int{
		return $this->_create(
			$user,
			$group,
			$data['valid_from']??null,
			$data['valid_till']??null
		);
	}
	protected function _create(int $user,int $group,?string $valid_from,?string $valid_till):int{
		return $this->connectors->db->query('
			insert into `_user-_group`
			set 
				`_user`='.$user.',
				`_group`='.$group.',
				`valid_from`='.(isnull($valid_from)?'curdate()':'"'.$this->connectors->db->escape($valid_from).'"').',
				`valid_till`='.(isnull($valid_till)?'null':'"'.$this->connectors->db>escape($valid_till).'"').'
		');
	}
}
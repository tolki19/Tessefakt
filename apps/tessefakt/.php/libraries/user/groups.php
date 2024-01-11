<?php
namespace tessefakt\apps\tessefakt\libraries\user;
class groups extends \tessefakt\library{
	public function create(
		int $user,
		int $group,
		string|null $valid_from=null,
		string|null $valid_till=null
	):int{
		return $this->_create(
			user:$user,
			group:$group,
			valid_from:$valid_from,
			valid_till:$valid_till
		);
	}
	protected function _create(
		int $user,
		int $group,
		string|null $valid_from,
		string|null $valid_till
	):int{
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
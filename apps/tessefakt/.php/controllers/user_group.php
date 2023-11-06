<?php
namespace tessefakt\apps\tessefakt\controllers;
class user_group extends \tessefakt\controller{
	public function create(int $user,int $group,array $data):int{
		return $this->_create(
			$user,
			$group,
			$data['valid_from']??null,
			$data['valid_till']??null
		);
	}
	protected function _create(int $user,int $group,?string $valid_from,?string $valid_till):int{
		return $this->db->current->query('
			insert into `_user-_group`
			set 
				`_user`='.$user.',
				`_group`='.$group.',
				`valid_from`='.(isnull($valid_from)?'curdate()':'"'.$this->db->current->escape($valid_from).'"').',
				`valid_till`='.(isnull($valid_till)?'null':'"'.$this->db->current>escape($valid_till).'"').'
		');
	}
}
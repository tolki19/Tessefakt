<?php
namespace tessefakt\apps\tessefakt\controllers;
class error extends \tessefakt\controller{
	public function create(int|string|null $user,array $data):int{
		return $this->_create(
			$user,
			$data['timestamp'],
			$data['error'],
			$data['remark']
		);
	}
	protected function _create(int|string|null $user,?int $timestamp,string $error,?string $remark):int{
		$this->db->current->query('
			insert into `_errors`
			set 
				`__user`='.(is_null($user)?'null':'"'.$this->db->current->escape($user).'"').',
				`timestamp`='.(is_null($timestamp)?'now()':'"'.$this->db->current->escape($timestamp).'"').',
				`error`="'.$this->db->current->escape($error).'",
				`remark`='.(is_null($remark)?'null':'"'.$this->db->current->escape($remark).'"').'
		');
		$iId=$this->db->current->insert();
		return $iId;
	}
}
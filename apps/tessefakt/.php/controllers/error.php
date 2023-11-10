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
		$this->connectors->db->query('
			insert into `_errors`
			set 
				`__user`='.(is_null($user)?'null':'"'.$this->connectors->db->escape($user).'"').',
				`timestamp`='.(is_null($timestamp)?'now()':'"'.$this->connectors->db->escape($timestamp).'"').',
				`error`="'.$this->connectors->db->escape($error).'",
				`remark`='.(is_null($remark)?'null':'"'.$this->connectors->db->escape($remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
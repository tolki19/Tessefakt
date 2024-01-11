<?php
namespace tessefakt\apps\tessefakt\libraries;
class errors extends \tessefakt\library{
	public function create(
		string $error,
		int|string|null $user=null,
		int|null $timestamp=null,
		string|null $remark=null
	):int{
		return $this->_create(
			error:$error,
			user:$user,
			timestamp:$timestamp,
			remark:$remark
		);
	}
	protected function _create(
		string $error,
		int|string|null $user=null,
		int|null $timestamp=null,
		string|null $remark=null
	):int{
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
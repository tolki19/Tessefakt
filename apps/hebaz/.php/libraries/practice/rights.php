<?php
namespace tessefakt\apps\hebaz\libraries\practice;
class rights extends \tessefakt\library{
	public function create(
		int $practice,
		int|null $_group=null,
		int|null $_user=null,
		int|string|null $from=null,
		int|string|null $till=null,
		string|null $internal_remark=null,
		bool|int|null $right_create=null,
		bool|int|null $right_read=null,
		bool|int|null $right_update=null,
		bool|int|null $right_delete=null
	):int{
		return $this->_create(
			practice:$practice,
			_group:$_group,
			_user:$_user,
			from:$from,
			till:$till,
			internal_remark:$internal_remark,
			right_create:$right_create,
			right_read:$right_read,
			right_update:$right_update,
			right_delete:$right_delete
		);
	}
	protected function _create(
		int $practice,
		int|null $_group,
		int|null $_user,
		int|string|null $from,
		int|string|null $till,
		string|null $internal_remark,
		bool|int|null $right_create,
		bool|int|null $right_read,
		bool|int|null $right_update,
		bool|int|null $right_delete
	):int{
		$this->connectors->db->query('
			insert into `practice-rights`
			set
				`practice`='.$practice.',
				`_group`='.(is_null($_group)?'null':'"'.$this->connectors->db->escape($_group).'"').',
				`_user`='.(is_null($_user)?'null':'"'.$this->connectors->db->escape($_user).'"').',
				`from`='.(is_null($from)?'null':(is_int($from)?'"'.date('Y-m-d H:i:s',$from).'"':'"'.$this->connectors->db->escape($from).'"')).',
				`till`='.(is_null($till)?'null':(is_int($till)?'"'.date('Y-m-d H:i:s',$till).'"':'"'.$this->connectors->db->escape($till).'"')).',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').',
				`right_create`='.(is_null($right_create)?'null':((bool)$right_create?'true':'false')).',
				`right_read`='.(is_null($right_read)?'null':((bool)$right_read?'true':'false')).',
				`right_update`='.(is_null($right_update)?'null':((bool)$right_update?'true':'false')).',
				`right_delete`='.(is_null($right_delete)?'null':((bool)$right_delete?'true':'false')).'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
	public function update(
		int $id,
		int $practice,
		int|null $_group=null,
		int|null $_user=null,
		int|string|null $from=null,
		int|string|null $till=null,
		string|null $internal_remark=null,
		bool|int|null $right_create=null,
		bool|int|null $right_read=null,
		bool|int|null $right_update=null,
		bool|int|null $right_delete=null
	):int{
		return $this->_update(
			id:$id,
			practice:$practice,
			_group:$_group,
			_user:$_user,
			from:$from,
			till:$till,
			internal_remark:$internal_remark,
			right_create:$right_create,
			right_read:$right_read,
			right_update:$right_update,
			right_delete:$right_delete
		);
	}
	protected function _update(
		int $id,
		int $practice,
		int|null $_group,
		int|null $_user,
		int|string|null $from,
		int|string|null $till,
		string|null $internal_remark,
		bool|int|null $right_create,
		bool|int|null $right_read,
		bool|int|null $right_update,
		bool|int|null $right_delete
	):int{
		$this->connectors->db->query('
			update `practice-rights`
			set
				`practice`='.$practice.',
				`_group`='.(is_null($_group)?'null':'"'.$this->connectors->db->escape($_group).'"').',
				`_user`='.(is_null($_user)?'null':'"'.$this->connectors->db->escape($_user).'"').',
				`from`='.(is_null($from)?'null':(is_int($from)?'"'.date('Y-m-d H:i:s',$from).'"':'"'.$this->connectors->db->escape($from).'"')).',
				`till`='.(is_null($till)?'null':(is_int($till)?'"'.date('Y-m-d H:i:s',$till).'"':'"'.$this->connectors->db->escape($till).'"')).',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').',
				`right_create`='.(is_null($right_create)?'null':((bool)$right_create?'true':'false')).',
				`right_read`='.(is_null($right_read)?'null':((bool)$right_read?'true':'false')).',
				`right_update`='.(is_null($right_update)?'null':((bool)$right_update?'true':'false')).',
				`right_delete`='.(is_null($right_delete)?'null':((bool)$right_delete?'true':'false')).'
			where `id`='.$id.'
		');
		return $id;
	}
	public function delete(
		int $id,
	):int{
		return $this->_delete(
			id:$id,
		);
	}
	protected function _delete(
		int $id,
	):int{
		$this->connectors->db->query('
			delete from `practice-rights`
			where `id`='.$id.'
		');
		return $id;
	}
}
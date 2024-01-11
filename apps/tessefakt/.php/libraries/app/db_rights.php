<?php
namespace tessefakt\apps\tessefakt\libraries\app;
class db_rights extends \tessefakt\library{
	public function create(
		int $app,
		string $table,
		int|null $group=null,
		int|null $user=null,
		string|int|null $set=null,
		string|null $field=null,
		string|int|null $right_create=null,
		string|int|null $right_read=null,
		string|int|null $right_update=null,
		string|int|null $right_delete=null,
		string|null $remark=null
	):int{
		return $this->_create(
			app:$app,
			table:$table,
			group:$group,
			user:$user,
			set:$set,
			field:$field,
			right_create:$right_create,
			right_read:$right_read,
			right_update:$right_update,
			right_delete:$right_delete,
			remark:$remark
		);
	}
	protected function _create(
		int $app,
		string $table,
		int|null $group,
		int|null $user,
		string|int|null $set,
		string|null $field,
		string|int|null $right_create,
		string|int|null $right_read,
		string|int|null $right_update,
		string|int|null $right_delete,
		string|null $remark
	):int{
		$this->connectors->db->query('
			insert into `_app-db-rights`
			set
				`_app`='.$app.',
				`_group`='.($group??'null').',
				`_user`='.($user??'null').',
				`table`="'.$this->connectors->db->escape($table).'",
				`set`='.(is_null($set)?'null':'"'.$this->connectors->db->escape($set).'"').',
				`field`='.(is_null($field)?'null':'"'.$this->connectors->db->escape($field).'"').',
				`right_create`='.(is_null($right_create)?'null':'"'.$this->connectors->db->escape($right_create).'"').',
				`right_read`='.(is_null($right_read)?'null':'"'.$this->connectors->db->escape($right_read).'"').',
				`right_update`='.(is_null($right_update)?'null':'"'.$this->connectors->db->escape($right_update).'"').',
				`right_delete`='.(is_null($right_delete)?'null':'"'.$this->connectors->db->escape($right_delete).'"').',
				`remark`='.(is_null($remark)?'null':'"'.$this->connectors->db->escape($remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
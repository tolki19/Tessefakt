<?php
namespace tessefakt\apps\tessefakt\libraries\apps;
class db_touches extends \tessefakt\library{
	public function create(
		int $app,
		string $touch,
		string $table,
		int|null $user=null,
		int|string|null $timestamp=null,
		int|null $set=null,
		string|null $field=null,
		string|null $remark=null
	):int{
		return $this->_create(
			app:$app,
			touch:$touch,
			table:$table,
			user:$user,
			timestamp:$timestamp,
			set:$set,
			field:$field,
			remark:$remark
		);
	}
	protected function _create(
		int $app,
		string $touch,
		string $table,
		int|null $user,
		int|string|null $timestamp,
		int|null $set,
		string|null $field,
		string|null $remark
	):int{
		$this->connectors->db->query('
			insert into `_app-db_touches`
			set
				`_app`='.$app.',
				`__user`='.($user??'null').',
				`timestamp`='.(is_null($timestamp)?'curdate()':(is_int($timestamp)?'"'.date('Y-m-d H:i:s',$timestamp).'"':'"'.$this->connectors->db->escape($controller).'"')).',
				`touch`="'.$this->connectors->db->escape($touch).'",
				`table`="'.$this->connectors->db->escape($table).'",
				`set`='.($set??'null').',
				`field`='.(is_null($field)?'null':'"'.$this->connectors->db->escape($field).'"').',
				`remark`='.(is_null($remark)?'null':'"'.$this->connectors->db->escape($remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
	public function update(
		int $id,
		int $app,
		string $touch,
		string $table,
		int|null $user=null,
		int|string|null $timestamp=null,
		int|null $set=null,
		string|null $field=null,
		string|null $remark=null
	):int{
		return $this->_update(
			id:$id,
			app:$app,
			touch:$touch,
			table:$table,
			user:$user,
			timestamp:$timestamp,
			set:$set,
			field:$field,
			remark:$remark
		);
	}
	protected function _update(
		int $id,
		int $app,
		string $touch,
		string $table,
		int|null $user,
		int|string|null $timestamp,
		int|null $set,
		string|null $field,
		string|null $remark
	):int{
		$this->connectors->db->query('
			update `_app-db_touches`
			set
				`_app`='.$app.',
				`__user`='.($user??'null').',
				`timestamp`='.(is_null($timestamp)?'curdate()':(is_int($timestamp)?'"'.date('Y-m-d H:i:s',$timestamp).'"':'"'.$this->connectors->db->escape($controller).'"')).',
				`touch`="'.$this->connectors->db->escape($touch).'",
				`table`="'.$this->connectors->db->escape($table).'",
				`set`='.($set??'null').',
				`field`='.(is_null($field)?'null':'"'.$this->connectors->db->escape($field).'"').',
				`remark`='.(is_null($remark)?'null':'"'.$this->connectors->db->escape($remark).'"').'
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
			delete `_app-db_touches`
			where `id`='.$id.'
		');
		return $id;
	}
}
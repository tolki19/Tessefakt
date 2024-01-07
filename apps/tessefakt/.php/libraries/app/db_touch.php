<?php
namespace tessefakt\apps\tessefakt\libraries\app;
class db_touch extends \tessefakt\library{
	public function create(int $app,int|null $user,array $data):int{
		return $this->_create(
			$app,
			$user,
			$data['timestamp'],
			$data['touch'],
			$data['table'],
			$data['set'],
			$data['field'],
			$data['remark']
		);
	}
	protected function _create(int $app,int|null $user,int|string|null $timestamp,string $touch,string $table,int|null $set,string|null $field,string|null $remark):int{
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
}
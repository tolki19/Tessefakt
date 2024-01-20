<?php
namespace tessefakt\apps\tessefakt\libraries\apps;
class tables extends \tessefakt\library{
	public function create(
		int $app,
		string $table,
		string $version,
		string $state="active",
	):int{
		return $this->_create(
			app:$app,
			table:$table,
			state:$state,
			version:$version
		);
	}
	protected function _create(
		int $app,
		string $table,
		string $version,
		string $state,
	):int{
		$this->connectors->db->query('
			insert into `_app-tables`
			set
				`_app`='.$app.',
				`table`="'.$this->connectors->db->escape($table).'",
				`state`="'.$this->connectors->db->escape($state).'",
				`version`="'.$this->connectors->db->escape($version).'"
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
	public function read(
		array|null $columns=null,
		array|null $where=null,
		array|null $order=null,
		array|null $limit=null,
	):array{
		return $this->_read(
			columns:$columns,
			where:$where,
			order:$order,
			limit:$limit,
		);
	}
	protected function _read(
		array|null $columns,
		array|null $where,
		array|null $order,
		array|null $limit,
	):array{
		return $this->connectors->db->query('
			select '.(is_null($columns)||!count($columns)?'*':'`'.implode('`,`',$columns).'`').'
			from `_app-tables`
			where '.(is_null($where)||!count($where)?'1':implode(' and ',array_recombine($where,function($key,$value){ return '`'.$key.'`='.(is_null($value)?'null':'"'.$this->connectors->db->escape($value).'"'); }))).'
			'.(is_null($order)||!count($order)?'':'order '.implode(',',array_recombine($order,function($key,$value){ return '`'.$key.'` '.(is_null($value)?'asc':$value); }))).'
			'.(is_null($limit)||!count($limit)?'':implode(' ',array_filter([(isset($limit['offset'])?'offset '.$limit['offset']:''),(isset($limit['fetch'])?' fetch '.$limit['fetch']:'')],'strlen'))).'
		');
	}
	public function update(
		int $id,
		int $app,
		string $table,
		string $version,
		string $state="active",
	):int{
		return $this->_update(
			id:$id,
			app:$app,
			table:$table,
			state:$state,
			version:$version
		);
	}
	protected function _update(
		int $id,
		int $app,
		string $table,
		string $version,
		string $state,
	):int{
		$this->connectors->db->query('
			update `_app-tables`
			set
				`_app`='.$app.',
				`table`="'.$this->connectors->db->escape($table).'",
				`state`="'.$this->connectors->db->escape($state).'",
				`version`="'.$this->connectors->db->escape($version).'"
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
			delete `_app-tables`
			where `id`='.$id.'
		');
		return $id;
	}
}
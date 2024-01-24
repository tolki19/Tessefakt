<?php
namespace tessefakt\apps\tessefakt\libraries;
class apps extends \tessefakt\library{
	public function create(
		string $key,
		string $name,
		string $major,
		string $minor,
		string $build,
		string $caption
	):int{
		return $this->_create(
			key:$key,
			name:$name,
			major:$major,
			minor:$minor,
			build:$build,
			caption:$caption
		);
	}
	protected function _create(
		string $key,
		string $name,
		string $major,
		string $minor,
		string $build,
		string $caption
	):int{
		$this->connectors->db->query('
			insert into `_apps`
			set 
				`key`="'.$this->connectors->db->escape($key).'",
				`name`="'.$this->connectors->db->escape($name).'",
				`major`="'.$this->connectors->db->escape($major).'",
				`minor`="'.$this->connectors->db->escape($minor).'",
				`build`="'.$this->connectors->db->escape($build).'",
				`caption`="'.$this->connectors->db->escape($caption).'"
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
			from `_apps`
			where '.(is_null($where)||!count($where)?'1':implode(' and ',array_recombine($where,function($key,$value){ return '`'.$key.'`='.(is_null($value)?'null':'"'.$this->connectors->db->escape($value).'"'); }))).'
			'.(is_null($order)||!count($order)?'':'order '.implode(',',$order)).'
			'.(is_null($limit)||!count($limit)?'':implode(' ',array_filter([(isset($limit['offset'])?'offset '.$limit['offset']:''),(isset($limit['fetch'])?' fetch '.$limit['fetch']:'')],'strlen'))).'
		');
	}
	public function update(
		int $id,
		string $key,
		string $name,
		string $major,
		string $minor,
		string $build,
		string $caption
	):int{
		return $this->_update(
		 	id:$id,
			key:$key,
			name:$name,
			major:$major,
			minor:$minor,
			build:$build,
			caption:$caption
		);
	}
	protected function _update(
		int $id,
		string $key,
		string $name,
		string $major,
		string $minor,
		string $build,
		string $caption
	):int{
		$this->connectors->db->query('
			update `_apps`
			set 
				`key`="'.$this->connectors->db->escape($key).'",
				`name`="'.$this->connectors->db->escape($name).'",
				`major`="'.$this->connectors->db->escape($major).'",
				`minor`="'.$this->connectors->db->escape($minor).'",
				`build`="'.$this->connectors->db->escape($build).'",
				`caption`="'.$this->connectors->db->escape($caption).'"
			where `id`='.$id.'
		');
		return $id;
	}
	public function delete(
		int $id,
	):int{
		foreach($this->subs->cm_rights->read(columns:['id'],where:['_user'=>$id]) as $aSet) $this->subs->cm_rights->delete(id:$aSet['id']);
		foreach($this->subs->cm_touches->read(columns:['id'],where:['_user'=>$id]) as $aSet) $this->subs->cm_touches->delete(id:$aSet['id']);
		foreach($this->subs->db_rights->read(columns:['id'],where:['_user'=>$id]) as $aSet) $this->subs->db_rights->delete(id:$aSet['id']);
		foreach($this->subs->db_touches->read(columns:['id'],where:['_user'=>$id]) as $aSet) $this->subs->db_touches->delete(id:$aSet['id']);
		foreach($this->subs->tpl_rights->read(columns:['id'],where:['_user'=>$id]) as $aSet) $this->subs->tpl_rights->delete(id:$aSet['id']);
		foreach($this->subs->tpl_touches->read(columns:['id'],where:['_user'=>$id]) as $aSet) $this->subs->tpl_touches->delete(id:$aSet['id']);
		foreach($this->subs->tables->read(columns:['id'],where:['_user'=>$id]) as $aSet) $this->subs->tables->delete(id:$aSet['id']);
		return $this->_delete(id:$id,);
	}
	protected function _delete(
		int $id,
	):int{
		$this->connectors->db->query('
			delete from `_apps`
			where `id`='.$id.'
		');
		return $id;
	}
}
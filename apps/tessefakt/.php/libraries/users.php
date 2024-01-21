<?php
namespace tessefakt\apps\tessefakt\libraries;
class users extends \tessefakt\library{
	public function create():int{
		$iUser=$this->_create();
		return $iUser;
	}
	protected function _create():int{
		$this->connectors->db->query('
			insert into `_users`
			set 
				`id`=default
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
			from `_users`
			where '.(is_null($where)||!count($where)?'1':implode(' and ',array_recombine($where,function($key,$value){ return '`'.$key.'`='.(is_null($value)?'null':'"'.$this->connectors->db->escape($value).'"'); }))).'
			'.(is_null($order)||!count($order)?'':'order '.implode(',',array_recombine($order,function($key,$value){ return '`'.$key.'` '.(is_null($value)?'asc':$value); }))).'
			'.(is_null($limit)||!count($limit)?'':implode(' ',array_filter([(isset($limit['offset'])?'offset '.$limit['offset']:''),(isset($limit['fetch'])?' fetch '.$limit['fetch']:'')],'strlen'))).'
		');
	}
	public function update(
		int $id,
	):int{
		return $this->_update(
			id:$id
		);
	}
	protected function _update(
		int $id,
	):int{
		// $this->connectors->db->query('
		// 	update `_users`
		// 	where `id`='.$id.'
		// ');
		return $id;
	}
	public function delete(
		int $id,
	):int{
		foreach($this->subs->emails->read(columns:['id'],where:['_user'=>$id]) as $aSet) $this->subs->emails->delete(id:$aSet['id']);
		foreach($this->subs->groups->read(columns:['id'],where:['_user'=>$id]) as $aSet) $this->subs->groups->delete(id:$aSet['id']);
		foreach($this->subs->hashes->read(columns:['id'],where:['_user'=>$id]) as $aSet) $this->subs->hashes->delete(id:$aSet['id']);
		foreach($this->subs->uids->read(columns:['id'],where:['_user'=>$id]) as $aSet) $this->subs->uids->delete(id:$aSet['id']);
		return $this->_delete(
			id:$id
		);
	}
	protected function _delete(
		int $id,
	):int{
		$this->connectors->db->query('
			delete from `_users`
			where `id`='.$id.'
		');
		return $id;
	}
}
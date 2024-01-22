<?php
namespace tessefakt\apps\hebaz\libraries;
class statics extends \tessefakt\library{
	public function create(
		string $keystring,
		string $content,
		string $internal_caption,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			keystring:$keystring,
			content:$content,
			internal_caption:$internal_caption,
			internal_remark:$internal_remark
		);
	}
	protected function _create(
		string $keystring,
		string $content,
		string $internal_caption,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			insert into `statics`
			set
				`keystring`="'.$this->connectors->db->escape($keystring).'",
				`content`="'.$this->connectors->db->escape($content).'",
				`internal-caption`="'.$this->connectors->db->escape($internal_caption).'",
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
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
			from `statics`
			where '.(is_null($where)||!count($where)?'1':implode(' and ',array_recombine($where,function($key,$value){ return '`'.$key.'`='.(is_null($value)?'null':'"'.$this->connectors->db->escape($value).'"'); }))).'
			'.(is_null($order)||!count($order)?'':'order '.implode(',',array_recombine($order,function($key,$value){ return '`'.$key.'` '.(is_null($value)?'asc':$value); }))).'
			'.(is_null($limit)||!count($limit)?'':implode(' ',array_filter([(isset($limit['offset'])?'offset '.$limit['offset']:''),(isset($limit['fetch'])?' fetch '.$limit['fetch']:'')],'strlen'))).'
		');
	}
	public function update(
		int $id,
		string $keystring,
		string $content,
		string $internal_caption,
		string|null $internal_remark=null
	):int{
		return $this->_update(
			id:$id,
			keystring:$keystring,
			content:$content,
			internal_caption:$internal_caption,
			internal_remark:$internal_remark
		);
	}
	protected function _update(
		int $id,
		string $keystring,
		string $content,
		string $internal_caption,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			update `statics`
			set
				`keystring`="'.$this->connectors->db->escape($keystring).'",
				`content`="'.$this->connectors->db->escape($content).'",
				`internal-caption`="'.$this->connectors->db->escape($internal_caption).'",
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
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
			update `statics`
			where `id`='.$id.'
		');
		return $id;
	}
}
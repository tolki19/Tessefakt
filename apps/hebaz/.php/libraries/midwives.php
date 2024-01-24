<?php
namespace tessefakt\apps\hebaz\libraries;
class midwives extends \tessefakt\library{
	public function create(
		string $first_name,
		string $last_name,
		string|null $keywords=null,
		string|null $public_caption=null,
		string|null $public_remark=null,
		string|null $internal_caption=null,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			first_name:$first_name,
			last_name:$last_name,
			keywords:$keywords,
			public_caption:$public_caption,
			public_remark:$public_remark,
			internal_caption:$internal_caption,
			internal_remark:$internal_remark,
		);
	}
	protected function _create(
		string $first_name,
		string $last_name,
		string|null $keywords,
		string|null $public_caption,
		string|null $public_remark,
		string|null $internal_caption,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			insert into `regions`
			set
				`first_name`="'.$this->connectors->db->escape($first_name).'",
				`last_name`="'.$this->connectors->db->escape($last_name).'",
				`keywords`='.(is_null($keywords)?'null':'"'.$this->connectors->db->escape($keywords).'"').',
				`public-caption`='.(is_null($public_caption)?'null':'"'.$this->connectors->db->escape($public_caption).'"').',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-caption`='.(is_null($internal_caption)?'null':'"'.$this->connectors->db->escape($internal_caption).'"').',
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
			from `midwives`
			where '.(is_null($where)||!count($where)?'1':implode(' and ',array_recombine($where,function($key,$value){ return '`'.$key.'`='.(is_null($value)?'null':'"'.$this->connectors->db->escape($value).'"'); }))).'
			'.(is_null($order)||!count($order)?'':'order '.implode(',',$order)).'
			'.(is_null($limit)||!count($limit)?'':implode(' ',array_filter([(isset($limit['offset'])?'offset '.$limit['offset']:''),(isset($limit['fetch'])?' fetch '.$limit['fetch']:'')],'strlen'))).'
		');
	}
	public function update(
		int $id,
		string $first_name,
		string $last_name,
		string|null $keywords=null,
		string|null $public_caption=null,
		string|null $public_remark=null,
		string|null $internal_caption=null,
		string|null $internal_remark=null
	):int{
		return $this->_update(
			id:$id,
			first_name:$first_name,
			last_name:$last_name,
			keywords:$keywords,
			public_caption:$public_caption,
			public_remark:$public_remark,
			internal_caption:$internal_caption,
			internal_remark:$internal_remark,
		);
	}
	protected function _update(
		int $id,
		string $first_name,
		string $last_name,
		string|null $keywords,
		string|null $public_caption,
		string|null $public_remark,
		string|null $internal_caption,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			update `regions`
			set
				`first_name`="'.$this->connectors->db->escape($first_name).'",
				`last_name`="'.$this->connectors->db->escape($last_name).'",
				`keywords`='.(is_null($keywords)?'null':'"'.$this->connectors->db->escape($keywords).'"').',
				`public-caption`='.(is_null($public_caption)?'null':'"'.$this->connectors->db->escape($public_caption).'"').',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-caption`='.(is_null($internal_caption)?'null':'"'.$this->connectors->db->escape($internal_caption).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
			where `id`='.$id.'
		');
		return $id;
	}
	public function delete(
		int $id,
	):int{
		foreach($this->subs->cds->read(columns:['id'],where:['_user'=>$id]) as $aSet) $this->subs->cds->delete(id:$aSet['id']);
		foreach($this->subs->languages->read(columns:['id'],where:['_user'=>$id]) as $aSet) $this->subs->languages->delete(id:$aSet['id']);
		foreach($this->subs->occupancies->read(columns:['id'],where:['_user'=>$id]) as $aSet) $this->subs->occupancies->delete(id:$aSet['id']);
		foreach($this->subs->regions->read(columns:['id'],where:['_user'=>$id]) as $aSet) $this->subs->regions->regionselete(id:$aSet['id']);
		foreach($this->subs->rights->read(columns:['id'],where:['_user'=>$id]) as $aSet) $this->subs->rights->rights(id:$aSet['id']);
		foreach($this->subs->services->read(columns:['id'],where:['_user'=>$id]) as $aSet) $this->subs->services->services(id:$aSet['id']);
		foreach($this->subs->states->read(columns:['id'],where:['_user'=>$id]) as $aSet) $this->subs->states->delete(id:$aSet['id']);
		foreach($this->subs->vacancies->read(columns:['id'],where:['_user'=>$id]) as $aSet) $this->subs->vacancies->delete(id:$aSet['id']);
		return $this->_delete(
			id:$id,
		);
	}
	protected function _delete(
		int $id,
	):int{
		$this->connectors->db->query('
			delete from `regions`
			where `id`='.$id.'
		');
		return $id;
	}
}
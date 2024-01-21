<?php
namespace tessefakt\apps\tessefakt\libraries\apps;
class tpl_touches extends \tessefakt\library{
	public function create(
		int $app,
		string $touch,
		string $tpl,
		int|null $user=null,
		int|string|null $timestamp=null,
		string|null $div=null,
		string|null $remark=null
	):int{
		return $this->_create(
			app:$app,
			touch:$touch,
			tpl:$tpl,
			user:$user,
			timestamp:$timestamp,
			div:$div,
			remark:$remark
		);
	}
	protected function _create(
		int $app,
		string $touch,
		string $tpl,
		int|null $user,
		int|string|null $timestamp,
		string|null $div,
		string|null $remark
	):int{
		$this->connectors->db->query('
			insert into `_apps-tpl_touches`
			set
				`_app`='.$app.',
				`__user`='.($user??'null').',
				`timestamp`='.(is_null($timestamp)?'curdate()':(is_int($timestamp)?'"'.date('Y-m-d H:i:s',$timestamp).'"':'"'.$this->connectors->db->escape($controller).'"')).',
				`touch`="'.$this->connectors->db->escape($touch).'",
				`tpl`="'.$this->connectors->db->escape($tpl).'",
				`div`='.(is_null($div)?'null':'"'.$this->connectors->db->escape($div).'"').',
				`remark`='.(is_null($remark)?'null':'"'.$this->connectors->db->escape($remark).'"').'
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
			from `_apps-tpl_touches`
			where '.(is_null($where)||!count($where)?'1':implode(' and ',array_recombine($where,function($key,$value){ return '`'.$key.'`='.(is_null($value)?'null':'"'.$this->connectors->db->escape($value).'"'); }))).'
			'.(is_null($order)||!count($order)?'':'order '.implode(',',array_recombine($order,function($key,$value){ return '`'.$key.'` '.(is_null($value)?'asc':$value); }))).'
			'.(is_null($limit)||!count($limit)?'':implode(' ',array_filter([(isset($limit['offset'])?'offset '.$limit['offset']:''),(isset($limit['fetch'])?' fetch '.$limit['fetch']:'')],'strlen'))).'
		');
	}
	public function update(
		int $id,
		int $app,
		string $touch,
		string $tpl,
		int|null $user=null,
		int|string|null $timestamp=null,
		string|null $div=null,
		string|null $remark=null
	):int{
		return $this->_update(
			id:$id,
			app:$app,
			touch:$touch,
			tpl:$tpl,
			user:$user,
			timestamp:$timestamp,
			div:$div,
			remark:$remark
		);
	}
	protected function _update(
		int $id,
		int $app,
		string $touch,
		string $tpl,
		int|null $user,
		int|string|null $timestamp,
		string|null $div,
		string|null $remark
	):int{
		$this->connectors->db->query('
			update `_apps-tpl_touches`
			set
				`_app`='.$app.',
				`__user`='.($user??'null').',
				`timestamp`='.(is_null($timestamp)?'curdate()':(is_int($timestamp)?'"'.date('Y-m-d H:i:s',$timestamp).'"':'"'.$this->connectors->db->escape($controller).'"')).',
				`touch`="'.$this->connectors->db->escape($touch).'",
				`tpl`="'.$this->connectors->db->escape($tpl).'",
				`div`='.(is_null($div)?'null':'"'.$this->connectors->db->escape($div).'"').',
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
			delete from `_apps-tpl_touches`
			where `id`='.$id.'
		');
		return $id;
	}
}
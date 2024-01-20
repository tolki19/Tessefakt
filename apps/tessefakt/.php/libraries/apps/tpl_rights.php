<?php
namespace tessefakt\apps\tessefakt\libraries\apps;
class tpl_rights extends \tessefakt\library{
	public function create(
		int $app,
		string $tpl,
		int|null $group=null,
		int|null $user=null,
		string|null $div=null,
		string|int|null $right_display=null,
		string|int|null $right_input=null,
		string|null $remark=null
	):int{
		return $this->_create(
			app:$app,
			tpl:$tpl,
			group:$group,
			user:$user,
			div:$div,
			right_display:$right_display,
			right_input:$right_input,
			remark:$remark
		);
	}
	protected function _create(
		int $app,
		string $tpl,
		int|null $group,
		int|null $user,
		string|null $div,
		string|int|null $right_display,
		string|int|null $right_input,
		string|null $remark
	):int{
		$this->connectors->db->query('
			insert into `_app-tpl_rights`
			set
				`_app`='.$app.',
				`_group`='.($group??'null').',
				`_user`='.($user??'null').',
				`tpl`="'.$this->connectors->db->escape($table).'",
				`div`='.(is_null($div)?'null':'"'.$this->connectors->db->escape($div).'"').',
				`right_display`='.(is_null($right_display)?'null':'"'.$this->connectors->db->escape($right_display).'"').',
				`right_input`='.(is_null($right_input)?'null':'"'.$this->connectors->db->escape($right_input).'"').',
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
			from `_app-tpl_rights`
			where '.(is_null($where)||!count($where)?'1':implode(' and ',array_recombine($where,function($key,$value){ return '`'.$key.'`='.(is_null($value)?'null':'"'.$this->connectors->db->escape($value).'"'); }))).'
			'.(is_null($order)||!count($order)?'':'order '.implode(',',array_recombine($order,function($key,$value){ return '`'.$key.'` '.(is_null($value)?'asc':$value); }))).'
			'.(is_null($limit)||!count($limit)?'':implode(' ',array_filter([(isset($limit['offset'])?'offset '.$limit['offset']:''),(isset($limit['fetch'])?' fetch '.$limit['fetch']:'')],'strlen'))).'
		');
	}
	public function update(
		int $id,
		int $app,
		string $tpl,
		int|null $group=null,
		int|null $user=null,
		string|null $div=null,
		string|int|null $right_display=null,
		string|int|null $right_input=null,
		string|null $remark=null
	):int{
		return $this->_update(
			id:$id,
			app:$app,
			tpl:$tpl,
			group:$group,
			user:$user,
			div:$div,
			right_display:$right_display,
			right_input:$right_input,
			remark:$remark
		);
	}
	protected function _update(
		int $id,
		int $app,
		string $tpl,
		int|null $group,
		int|null $user,
		string|null $div,
		string|int|null $right_display,
		string|int|null $right_input,
		string|null $remark
	):int{
		$this->connectors->db->query('
			update `_app-tpl_rights`
			set
				`_app`='.$app.',
				`_group`='.($group??'null').',
				`_user`='.($user??'null').',
				`tpl`="'.$this->connectors->db->escape($table).'",
				`div`='.(is_null($div)?'null':'"'.$this->connectors->db->escape($div).'"').',
				`right_display`='.(is_null($right_display)?'null':'"'.$this->connectors->db->escape($right_display).'"').',
				`right_input`='.(is_null($right_input)?'null':'"'.$this->connectors->db->escape($right_input).'"').',
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
			delete `_app-tpl_rights`
			where `id`='.$id.'
		');
		return $id;
	}
}
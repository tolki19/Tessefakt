<?php
namespace tessefakt\apps\tessefakt\libraries\app;
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
			insert into `_app-tpl_touches`
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
			update `_app-tpl_touches`
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
			delete `_app-tpl_touches`
			where `id`='.$id.'
		');
		return $id;
	}
}
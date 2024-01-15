<?php
namespace tessefakt\apps\tessefakt\libraries;
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
			insert into `_app-tpl-rights`
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
			update `_app-tpl-rights`
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
			delete `_app-tpl-rights`
			where `id`='.$id.'
		');
		return $id;
	}
}
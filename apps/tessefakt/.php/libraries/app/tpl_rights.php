<?php
namespace tessefakt\apps\tessefakt\libraries;
class tpl_rights extends \tessefakt\library{
	public function create(int $app,int|null $group,int|null $user,array $data):int{
		return $this->_create(
			$app,
			$group,
			$user,
			$data['tpl'],
			$data['div'],
			$data['right_display'],
			$data['right_input'],
			$data['remark']
		);
	}
	protected function _create(int $app,int|null $group,int|null $user,string $tpl,string|null $div,string|int|null $right_display,string|int|null $right_input):int{
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
}
<?php
namespace tessefakt\apps\tessefakt\libraries\app;
class cm_rights extends \tessefakt\library{
	public function create(
		int $app,
		string $controller,
		int|null $group=null,
		int|null $user=null,
		string|null $method=null,
		string|int|null $right_execute=null,
		string|null $remark=null
	):int{
		return $this->_create(
			app:$app,
			controller:$controller,
			group:$group,
			user:$user,
			method:$method,
			right_execute:$right_execute,
			remark:$remark
		);
	}
	protected function _create(
		int $app,
		string $controller,
		int|null $group,
		int|null $user,
		string|null $method,
		string|int|null $right_execute,
		string|null $remark
	):int{
		$this->connectors->db->query('
			insert into `_app-cm-rights`
			set
				`_app`='.$app.',
				`_group`='.($group??'null').',
				`_user`='.($user??'null').',
				`controller`="'.$this->connectors->db->escape($controller).'",
				`method`='.(is_null($method)?'null':'"'.$this->connectors->db->escape($method).'"').',
				`right_execute`='.(is_null($right_execute)?'null':'"'.$this->connectors->db->escape($right_execute).'"').',
				`remark`='.(is_null($remark)?'null':'"'.$this->connectors->db->escape($remark).'"').'		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
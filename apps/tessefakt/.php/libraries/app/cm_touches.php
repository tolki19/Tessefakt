<?php
namespace tessefakt\apps\tessefakt\libraries\app;
class cm_touches extends \tessefakt\library{
	public function create(
		int $app,
		string $touch,
		string $controller,
		int|null $user=null,
		int|string|null $timestamp=null,
		string|null $method=null,
		string|null $remark=null
	):int{
		return $this->_create(
			app:$app,
			touch:$touch,
			controller:$controller,
			user:$user,
			timestamp:$timestamp,
			method:$method,
			remark:$remark
		);
	}
	protected function _create(
		int $app,
		string $touch,
		string $controller,
		int|null $user,
		int|string|null $timestamp,
		string|null $method,
		string|null $remark
	):int{
		$this->connectors->db->query('
			insert into `_app-cm_touches`
			set
				`_app`='.$app.',
				`__user`='.($user??'null').',
				`timestamp`='.(is_null($timestamp)?'curdate()':(is_int($timestamp)?'"'.date('Y-m-d H:i:s',$timestamp).'"':'"'.$this->connectors->db->escape($controller).'"')).',
				`touch`="'.$this->connectors->db->escape($touch).'",
				`controller`="'.$this->connectors->db->escape($controller).'",
				`method`='.(is_null($method)?'null':'"'.$this->connectors->db->escape($method).'"').',
				`remark`='.(is_null($remark)?'null':'"'.$this->connectors->db->escape($remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
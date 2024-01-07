<?php
namespace tessefakt\apps\tessefakt\libraries\app;
class tpl_touch extends \tessefakt\library{
	public function create(int $app,int|null $user,array $data):int{
		return $this->_create(
			$app,
			$user,
			$data['timestamp'],
			$data['touch'],
			$data['tpl'],
			$data['div'],
			$data['remark']
		);
	}
	protected function _create(int $app,int|null $user,int|string|null $timestamp,string $touch,string $tpl,string|null $div,string|null $remark):int{
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
}
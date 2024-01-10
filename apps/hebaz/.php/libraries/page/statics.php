<?php
namespace tessefakt\apps\hebaz\libraries\page;
class statics extends \tessefakt\library{
	public function create(int $page,array $data):int{
		return $this->_create(
			$page,
			$data['static'],
			$data['sort'],
			$data['from']??null,
			$data['till']??null,
			$data['internal-caption']??null,
			$data['internal-remark']??null
		);
	}
	protected function _create(int $page,int $static,int $sort,int|string|null $from,int|string|null $till,string|null $internal_caption,string|null $internal_remark):int{
		$this->connectors->db->query('
			insert into `page-statics`
			set
				`page`='.$page.',
				`static`='.$static.',
				`sort`='.$sort.',
				`from`='.(is_null($from)?'null':(is_int($from)?'"'.date('Y-m-d H:i:s',$from).'"':'"'.$this->connectors->db->escape($from).'"')).',
				`till`='.(is_null($till)?'null':(is_int($till)?'"'.date('Y-m-d H:i:s',$till).'"':'"'.$this->connectors->db->escape($till).'"')).',
				`internal-caption`='.(is_null($internal_caption)?'null':'"'.$this->connectors->db->escape($internal_caption).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
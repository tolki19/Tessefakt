<?php
namespace tessefakt\apps\hebaz\libraries\page;
class contents extends \tessefakt\library{
	public function create(
		int $page,
		int $sort,
		string $content,
		int|string|null $from=null,
		int|string|null $till=null,
		string|null $internal_caption=null,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			$page,
			sort:$sort,
			from:$from,
			till:$till,
			content:$content,
			internal_caption:$internal_caption,
			internal_remark:$internal_remark
		);
	}
	protected function _create(int $page,int $sort,int|string|null $from,int|string|null $till,string $content,string|null $internal_caption,string|null $internal_remark):int{
		$this->connectors->db->query('
			insert into `page-contents`
			set
				`page`='.$page.',
				`sort`='.$sort.',
				`from`='.(is_null($from)?'null':(is_int($from)?'"'.date('Y-m-d H:i:s',$from).'"':'"'.$this->connectors->db->escape($from).'"')).',
				`till`='.(is_null($till)?'null':(is_int($till)?'"'.date('Y-m-d H:i:s',$till).'"':'"'.$this->connectors->db->escape($till).'"')).',
				`content`="'.$this->connectors->db->escape($content).'",
				`internal-caption`='.(is_null($internal_caption)?'null':'"'.$this->connectors->db->escape($internal_caption).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
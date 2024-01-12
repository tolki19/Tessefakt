<?php
namespace tessefakt\apps\hebaz\libraries\navigation;
class page extends \tessefakt\library{
	public function create(
		int $navigation,
		int $sort,
		string $type,
		int $auto_speaking_url,
		int $auto_home,
		int|null $page=null,
		string|null $speaking_url=null,
		string|null $public_caption=null,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			$navigation,
			sort:$sort,
			type:$type,
			page:$page,
			auto_speaking_url:$auto_speaking_url,
			speaking_url:$speaking_url,
			auto_home:$auto_home,
			public_remark:$public_remark,
			internal_remark:$internal_remark
		);
	}
	protected function _create(int $navigation,int $sort,string $type,int|null $page,int $auto_speaking_url,string|null $speaking_url,int $auto_home,string|null $public_caption,string|null $internal_remark):int{
		$this->connectors->db->query('
			insert into `navigation-pages`
			set
				`navigation`='.$navigation.',
				`type`="'.$this->connectors->db->escape($type).'",
				`page`='.($page??'null').',
				`auto-speaking-url`='.$auto_speaking_url.',
				`speaking-url`='.(is_null($speaking_url)?'null':'"'.$this->connectors->db->escape($speaking_url).'"').',
				`auto-home`='.$auto_home.',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
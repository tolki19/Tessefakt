<?php
namespace tessefakt\apps\hebaz\libraries;
class languages extends \tessefakt\library{
	public function create(
		int $sort,
		string $name,
		int|null $language=null,
		string|null $keywords=null,
		string|null $public_caption=null,
		string|null $public_remark=null,
		string|null $internal_caption=null,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			$language,
			sort:$sort,
			name:$name,
			keywords:$keywords,
			public_caption:$public_caption,
			public_remark:$public_remark,
			internal_caption:$internal_caption,
			internal_remark:$internal_remark,
		);
	}
	protected function _create(
		int $sort,
		string $name,
		int|null $language,
		string|null $keywords,
		string|null $public_caption,
		string|null $public_remark,
		string|null $internal_caption,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			insert into `languages`
			set
				`language`='.($language??'null').',
				`sort`='.$sort.',
				`name`="'.$this->connectors->db->escape($name).'",
				`keywords`='.(is_null($keywords)?'null':'"'.$this->connectors->db->escape($keywords).'"').',
				`public-caption`='.(is_null($public_caption)?'null':'"'.$this->connectors->db->escape($public_caption).'"').',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-caption`='.(is_null($internal_caption)?'null':'"'.$this->connectors->db->escape($internal_caption).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
	public function update(
		int $id,
		int $sort,
		string $name,
		int|null $language=null,
		string|null $keywords=null,
		string|null $public_caption=null,
		string|null $public_remark=null,
		string|null $internal_caption=null,
		string|null $internal_remark=null
	):int{
		return $this->_update(
			id:$id,
			language:$language,
			sort:$sort,
			name:$name,
			keywords:$keywords,
			public_caption:$public_caption,
			public_remark:$public_remark,
			internal_caption:$internal_caption,
			internal_remark:$internal_remark,
		);
	}
	protected function _update(
		int $id,
		int $sort,
		string $name,
		int|null $language,
		string|null $keywords,
		string|null $public_caption,
		string|null $public_remark,
		string|null $internal_caption,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			update `languages`
			set
				`language`='.($language??'null').',
				`sort`='.$sort.',
				`name`="'.$this->connectors->db->escape($name).'",
				`keywords`='.(is_null($keywords)?'null':'"'.$this->connectors->db->escape($keywords).'"').',
				`public-caption`='.(is_null($public_caption)?'null':'"'.$this->connectors->db->escape($public_caption).'"').',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-caption`='.(is_null($internal_caption)?'null':'"'.$this->connectors->db->escape($internal_caption).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
			where `id`='.$id.'
		');
		return $id;
	}
}
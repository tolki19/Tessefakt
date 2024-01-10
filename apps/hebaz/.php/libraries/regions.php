<?php
namespace tessefakt\apps\hebaz\libraries;
class regions extends \tessefakt\library{
	public function create(int|null $region,array $data):int{
		return $this->_create(
			$region,
			$data['sort'],
			$data['name'],
			$data['keywords']??null,
			$data['public-caption']??null,
			$data['public-remark']??null,
			$data['internal-caption']??null,
			$data['internal-remark']??null,
		);
	}
	protected function _create(int|null $region,int $sort,string $name,string|null $keywords,string|null $public_caption,string|null $public_remark,string|null $internal_caption,string|null $internal_remark):int{
		$this->connectors->db->query('
			insert into `regions`
			set
				`region`='.($region??'null').',
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
}
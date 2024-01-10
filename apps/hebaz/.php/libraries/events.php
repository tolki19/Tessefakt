<?php
namespace tessefakt\apps\hebaz\libraries;
class events extends \tessefakt\library{
	public function create(int|null $event,array $data):int{
		return $this->_create(
			$event,
			$data['name'],
			$data['from']??null,
			$data['till']??null,
			$data['keywords']??null,
			$data['public-caption']??null,
			$data['public-remark']??null,
			$data['internal-caption']??null,
			$data['internal-remark']??null,
		);
	}
	protected function _create(int|null $event,string $name,string|int|null $from,string|int|null $till,string|null $keywords,string|null $public_caption,string|null $public_remark,string|null $internal_caption,string|null $internal_remark):int{
		$this->connectors->db->query('
			insert into `events`
			set
				`event`='.($event??'null').',
				`name`="'.$this->connectors->db->escape($name).'",
				`from`='.(is_null($from)?'null':(is_int($from)?'"'.date('Y-m-d H:i:s',$from).'"':'"'.$this->connectors->db->escape($from)).'"').',
				`till`='.(is_null($till)?'null':(is_int($till)?'"'.date('Y-m-d H:i:s',$till).'"':'"'.$this->connectors->db->escape($till).'"')).',
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
<?php
namespace tessefakt\apps\hebaz\libraries\page;
class statics extends \tessefakt\library{
	public function create(
		int $page,
		int $static,
		int $sort,
		int|string|null $from=null,
		int|string|null $till=null,
		string|null $internal_caption=null,
		string|null $internal_remark=null
	):int{
		return $this->_create(
			page:$page,
			static:$static,
			sort:$sort,
			from:$from,
			till:$till,
			internal_caption:$internal_caption,
			internal_remark:$internal_remark
		);
	}
	protected function _create(
		int $page,
		int $static,
		int $sort,
		int|string|null $from,
		int|string|null $till,
		string|null $internal_caption,
		string|null $internal_remark
	):int{
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
	public function update(
		int $id,
		int $page,
		int $static,
		int $sort,
		int|string|null $from=null,
		int|string|null $till=null,
		string|null $internal_caption=null,
		string|null $internal_remark=null
	):int{
		return $this->_update(
			id:$id,
			page:$page,
			static:$static,
			sort:$sort,
			from:$from,
			till:$till,
			internal_caption:$internal_caption,
			internal_remark:$internal_remark
		);
	}
	protected function _update(
		int $id,
		int $page,
		int $static,
		int $sort,
		int|string|null $from,
		int|string|null $till,
		string|null $internal_caption,
		string|null $internal_remark
	):int{
		$this->connectors->db->query('
			update `page-statics`
			set
				`page`='.$page.',
				`static`='.$static.',
				`sort`='.$sort.',
				`from`='.(is_null($from)?'null':(is_int($from)?'"'.date('Y-m-d H:i:s',$from).'"':'"'.$this->connectors->db->escape($from).'"')).',
				`till`='.(is_null($till)?'null':(is_int($till)?'"'.date('Y-m-d H:i:s',$till).'"':'"'.$this->connectors->db->escape($till).'"')).',
				`internal-caption`='.(is_null($internal_caption)?'null':'"'.$this->connectors->db->escape($internal_caption).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
			where `id`='.$id.'
		');
		return $id;
	}
	public function delete(
		int $id,
	):int{
		return $this->_delete(
			id:$id,
		);
	}
	protected function _delete(
		int $id,
	):int{
		$this->connectors->db->query('
			delete from `page-statics`
			where `id`='.$id.'
		');
		return $id;
	}
}
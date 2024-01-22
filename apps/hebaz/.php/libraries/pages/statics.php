<?php
namespace tessefakt\apps\hebaz\libraries\pages;
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
		$this->connectors->db->transaction();
		$this->connectors->db->query('
			select @sort:=least(greatest('.$sort.',0),ifnull(count(*),0))
			from `pages-statics`
			where `page`='.$page.'
		');
		$this->connectors->db->query('
			insert into `pages-statics`
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
		$this->connectors->db->query('
			update `pages-statics`
			set `sort`=`sort`+1
			where `page`='.$page.' and `sort`>=@sort and `id`!='.$iId.'
		');
		$this->connectors->db->commit();
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
		$this->connectors->db->transaction();
		$this->connectors->db->query('
			select @sort:=`sort`,@dep:=`page`
			from `pages-statics`
			where `id`='.$id.'
		');
		$this->connectors->db->query('
			update `pages-statics`
			set `sort`=`sort`-1
			where `page`=@dep and `sort`>@sort
		');
		$this->connectors->db->query('
			select @sort:=least(greatest('.$sort.',0),ifnull(count(*),0))
			from `pages-statics`
			where `page`='.$page.' and `id`!='.$id.'
		');
		$this->connectors->db->query('
			update `pages-statics`
			set
				`page`='.$page.',
				`static`='.$static.',
				`sort`=@sort,
				`from`='.(is_null($from)?'null':(is_int($from)?'"'.date('Y-m-d H:i:s',$from).'"':'"'.$this->connectors->db->escape($from).'"')).',
				`till`='.(is_null($till)?'null':(is_int($till)?'"'.date('Y-m-d H:i:s',$till).'"':'"'.$this->connectors->db->escape($till).'"')).',
				`internal-caption`='.(is_null($internal_caption)?'null':'"'.$this->connectors->db->escape($internal_caption).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
			where `id`='.$id.'
		');
		$this->connectors->db->query('
			update `pages-statics`
			set `sort`=`sort`+1
			where `page`='.$page.' and `sort`>=@sort and `id`!='.$id.'
		');
		$this->connectors->db->commit();
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
		$this->connectors->db->transaction();
		$this->connectors->db->query('
			select @sort:=`sort`,@dep:=`page`
			from `pages-statics`
			where `id`='.$id.'
		');
		$this->connectors->db->query('
			update `pages-statics`
			set `sort`=`sort`-1
			where `page`=@dep and `sort`>@sort
		');
		$this->connectors->db->query('
			delete from `pages-statics` 
			where `id`='.$id.'
		');
		$this->connectors->db->commit();
		return $id;
	}
}
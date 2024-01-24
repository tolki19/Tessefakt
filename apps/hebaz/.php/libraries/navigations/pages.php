<?php
namespace tessefakt\apps\hebaz\libraries\navigations;
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
			navigation:$navigation,
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
	protected function _create(
		int $navigation,
		int $sort,
		string $type,
		int $auto_speaking_url,
		int $auto_home,
		int|null $page,
		string|null $speaking_url,
		string|null $public_caption,
		string|null $internal_remark
	):int{
		$this->connectors->db->transaction();
		$this->connectors->db->query('
			select @sort:=least(greatest('.$sort.',0),ifnull(count(*),0))
			from `navigations-pages`
			where `navigation`='.$navigation.'
		');
		$this->connectors->db->query('
			insert into `navigations-pages`
			set
				`navigation`='.$navigation.',
				`sort`=@sort,
				`type`="'.$this->connectors->db->escape($type).'",
				`page`='.($page??'null').',
				`auto-speaking-url`='.$auto_speaking_url.',
				`speaking-url`='.(is_null($speaking_url)?'null':'"'.$this->connectors->db->escape($speaking_url).'"').',
				`auto-home`='.$auto_home.',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
		');
		$iId=$this->connectors->db->insert();
		$this->connectors->db->query('
			update `navigations-pages`
			set `sort`=`sort`+1
			where `navigation`='.$navigation.' and `sort`>=@sort and `id`!='.$iId.'
		');
		$this->connectors->db->commit();
		return $iId;
	}
	public function read(
		array|null $columns=null,
		array|null $where=null,
		array|null $order=null,
		array|null $limit=null,
	):array{
		return $this->_read(
			columns:$columns,
			where:$where,
			order:$order,
			limit:$limit,
		);
	}
	protected function _read(
		array|null $columns,
		array|null $where,
		array|null $order,
		array|null $limit,
	):array{
		return $this->connectors->db->query('
			select '.(is_null($columns)||!count($columns)?'*':'`'.implode('`,`',$columns).'`').'
			from `navigations-pages`
			where '.(is_null($where)||!count($where)?'1':implode(' and ',array_recombine($where,function($key,$value){ return '`'.$key.'`='.(is_null($value)?'null':'"'.$this->connectors->db->escape($value).'"'); }))).'
			'.(is_null($order)||!count($order)?'':'order '.implode(',',$order)).'
			'.(is_null($limit)||!count($limit)?'':implode(' ',array_filter([(isset($limit['offset'])?'offset '.$limit['offset']:''),(isset($limit['fetch'])?' fetch '.$limit['fetch']:'')],'strlen'))).'
		');
	}
	public function update(
		int $id,
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
		return $this->_update(
			id:$id,
			navigation:$navigation,
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
	protected function _update(
		int $id,
		int $navigation,
		int $sort,
		string $type,
		int $auto_speaking_url,
		int $auto_home,
		int|null $page,
		string|null $speaking_url,
		string|null $public_caption,
		string|null $internal_remark
	):int{
		$this->connectors->db->transaction();
		$this->connectors->db->query('
			select @sort:=`sort`,@dep:=`navigation`
			from `navigations-pages`
			where `id`='.$id.'
		');
		$this->connectors->db->query('
			update `navigations-pages`
			set `sort`=`sort`-1
			where `navigation`=@dep and `sort`>@sort
		');
		$this->connectors->db->query('
			select @sort:=least(greatest('.$sort.',0),ifnull(count(*),0))
			from `navigations-pages`
			where `navigation`='.$navigation.' and `id`!='.$id.'
		');
		$this->connectors->db->query('
			update `navigations-pages`
			set
				`navigation`='.$navigation.',
				`sort`=@sort,
				`type`="'.$this->connectors->db->escape($type).'",
				`page`='.($page??'null').',
				`auto-speaking-url`='.$auto_speaking_url.',
				`speaking-url`='.(is_null($speaking_url)?'null':'"'.$this->connectors->db->escape($speaking_url).'"').',
				`auto-home`='.$auto_home.',
				`public-remark`='.(is_null($public_remark)?'null':'"'.$this->connectors->db->escape($public_remark).'"').',
				`internal-remark`='.(is_null($internal_remark)?'null':'"'.$this->connectors->db->escape($internal_remark).'"').'
			where `id`='.$id.'
		');
		$this->connectors->db->query('
			update `navigations-pages`
			set `sort`=`sort`+1
			where `navigation`='.$navigation.' and `sort`>=@sort and `id`!='.$id.'
		');
		$this->connectors->db->commit();
		return $id;
	}
	public function delete(
		int $id,
		string|null $internal_remark=null
	):int{
		return $this->_delete(
			id:$id,
			internal_remark:$internal_remark
		);
	}
	protected function _delete(
		int $id,
		string|null $internal_remark
	):int{
		$this->connectors->db->transaction();
		$this->connectors->db->query('
			select @sort:=`sort`,@dep:=`navigation`
			from `navigations-pages`
			where `id`='.$id.'
		');
		$this->connectors->db->query('
			update `navigations-pages`
			set `sort`=`sort`-1
			where `navigation`=@dep and `sort`>@sort
		');
		$this->connectors->db->query('
			delete from `navigations-pages` 
			where `id`='.$id.'
		');
		$this->connectors->db->commit();
		return $id;
	}
}
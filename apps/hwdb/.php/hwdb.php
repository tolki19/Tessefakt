<?php
namespace mdf\apps;

class hwdb extends \mdf\app{
	private $__oRights=[];
	public function auth(){
// var_dump($this->mdf->operations->uid);
$this->__oRights=$this->db->query('
	select
		_user.uid,
		_user.rights|_group.rights rights
	from (
		select
			1 id,
			1 `group`,
			"floriantolk" uid,
			63 rights
	) _user
	inner join (
		select
			1 id,
			"Admin" name,
			62 rights
	) _group on
		_group.id=_user.`group`
	where
		_user.uid like "'.$this->db->escape($this->mdf->operations->uid).'"
');
	}
	public function __get(string $key){
		switch($key){
			case 'rights': 
				if(!$this->__oRights) $this->auth();
				return $this->__oRights;
		}
		return parent::__get($key);
	}
}
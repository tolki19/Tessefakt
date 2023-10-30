<?php
namespace tessefakt\apps\tessefakt\controllers;
class groups extends \tessefakt\controller{
	public function create(array $data):int{
		$group=$this->_create_group($data['name']);
		return $group;
	}
	protected function _create_group(string $name):int{
		$this->dbs->current->query('
			insert into `_groups`
			set 
				`name`="'.$this->dbs->current->escape($name).'"
		');
		return $this->dbs->current->insert();
	}
}
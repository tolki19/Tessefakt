<?php
namespace tessefakt\apps\tessefakt\controllers;
class app extends \tessefakt\controller{
	public function create_app(array $data):int{
		return $this->_create_app(
			$data['key'],
			$data['name'],
			$data['major'],
			$data['minor'],
			$data['build'],
			$data['caption']
		);
	}
	protected function _create_app(string $key,string $name,string $major,string $minor,string $build,string $caption):int{
		$this->dbs->current->query('
			insert into `_apps`
			set 
				`key`="'.$this->dbs->current->escape($key).'",
				`name`="'.$this->dbs->current->escape($name).'",
				`major`="'.$this->dbs->current->escape($major).'",
				`minor`="'.$this->dbs->current->escape($minor).'",
				`build`="'.$this->dbs->current->escape($build).'",
				`caption`="'.$this->dbs->current->escape($caption).'"
		');
		$iId=$this->dbs->current->insert();
		return $iId;
	}
}
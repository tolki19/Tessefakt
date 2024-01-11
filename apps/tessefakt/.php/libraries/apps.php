<?php
namespace tessefakt\apps\tessefakt\libraries;
class apps extends \tessefakt\library{
	public function create(
		string $key,
		string $name,
		string $major,
		string $minor,
		string $build,
		string $caption
	):int{
		return $this->_create(
			key:$key,
			name:$name,
			major:$major,
			minor:$minor,
			build:$build,
			caption:$caption
		);
	}
	protected function _create(
		string $key,
		string $name,
		string $major,
		string $minor,
		string $build,
		string $caption
	):int{
		$this->connectors->db->query('
			insert into `_apps`
			set 
				`key`="'.$this->connectors->db->escape($key).'",
				`name`="'.$this->connectors->db->escape($name).'",
				`major`="'.$this->connectors->db->escape($major).'",
				`minor`="'.$this->connectors->db->escape($minor).'",
				`build`="'.$this->connectors->db->escape($build).'",
				`caption`="'.$this->connectors->db->escape($caption).'"
		');
		$iId=$this->connectors->db->insert();
		return $iId;
	}
}
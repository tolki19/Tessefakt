<?php
namespace tessefakt\apps\tessefakt\libraries\install\build;
class structure extends \tessefakt\library{
	public function create():void{
		$aFiles=scandir_r(compilepath($this->app->setup['paths']['sql'].'/create'));
		foreach($aFiles as $sFile) $this->connectors->db->multi(file_get_contents($sFile));
	}
}

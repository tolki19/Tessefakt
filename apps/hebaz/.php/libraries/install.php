<?php
namespace tessefakt\apps\hebaz\libraries;
class install extends \tessefakt\library{
	public function create_structure():void{
		$aFiles=$this->_filesystem(compilepath($this->app->setup['paths']['sql'].'/create'));
		foreach($aFiles as $sFile) $this->connectors->db->multi(file_get_contents($sFile));
	}
	public function create_data():void{
	}
	public function translate_data():void{
var_dump($this->connectors->migrate->query('select * from languages'));
var_dump($this->connectors->migrate->query('select * from regions'));
var_dump($this->connectors->migrate->query('select * from services'));
var_dump($this->connectors->migrate->query('select * from practices'));
var_dump($this->connectors->migrate->query('select * from midwives'));
var_dump($this->connectors->migrate->query('select * from midwife_holidays'));
var_dump($this->connectors->migrate->query('select * from midwife_languages'));
var_dump($this->connectors->migrate->query('select * from midwife_regions'));
var_dump($this->connectors->migrate->query('select * from midwife_services'));
var_dump($this->connectors->migrate->query('select * from midwife_vacancies'));
var_dump($this->connectors->migrate->query('select * from events'));
var_dump($this->connectors->migrate->query('select * from pages'));
var_dump($this->connectors->migrate->query('select * from navigations'));
var_dump($this->connectors->migrate->query('select * from navigation_pages'));
	}
	protected function _filesystem(string $path):array|false{
		if(!($aFiles=scandir($path))) return false;
		$aReturn=[];
		foreach($aFiles as $sFile){
			if($sFile=='.'||$sFile=='..') continue;
			$sPath=$path.'/'.$sFile;
			if(is_file($sPath)) $aReturn[]=$sPath;
			else $aReturn=array_merge($aReturn,$this->_filesystem($sPath));
		}
		return $aReturn;
	}
}

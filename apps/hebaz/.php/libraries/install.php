<?php
namespace tessefakt\apps\hebaz\libraries;
class install extends \tessefakt\library{
	public function create_structure():void{
$aFiles=$this->_fs(compilepath($this->app->setup['paths']['sql'].'/create'));
foreach($aFiles as $sFile) $this->connectors->db->multi(file_get_contents($sFile));
	}
	public function create_data():void{
	}
	protected function _fs(string $path):array|false{
		if(!($aFiles=scandir($path))) return false;
		$aReturn=[];
		foreach($aFiles as $sFile){
			if($sFile=='.'||$sFile=='..') continue;
			$sPath=$path.'/'.$sFile;
			if(is_file($sPath)) $aReturn[]=$sPath;
			else $aReturn=array_merge($aReturn,$this->_fs($sPath));
		}
		return $aReturn;
	}
}

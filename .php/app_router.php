<?php
namespace tessefakt;
class app_router{
	protected $_oTessefakt;
	protected $_aApps=[];
	public function __construct(\tessefakt\tessefakt $tessefakt){
		$this->_oTessefakt=$tessefakt;
	}
	public function __get(string $key){
		if(!array_key_exists($key,$this->_aApps)){
			include(__DIR__.'/../apps/'.$key.'/.php/'.$key.'.php');
			$sClass='\tessefakt\apps\\'.$key;
			$this->_aApps[$key]=new $sClass($this->_oTessefakt,$this->_oTessefakt->setup['apps'][$key]);
		}
		return $this->_aApps[$key];
	}
	public function __set(string $key,$value){}
	public function stats(){
		$aStats=[];
		foreach($this->_aApps as $oApp){
			$aAppStats=$oApp->stats();
			foreach($aAppStats as $sArea=>$aMetrics){
				if(!array_key_exists($sArea,$aStats)) $aStats[$sArea]=[];
				foreach($aMetrics as $sMetric=>$mValue){
					if(!array_key_exists($sMetric,$aStats[$sArea])) $aStats[$sArea][$sMetric]=$mValue;
					else $aStats[$sArea][$sMetric]+=$mValue;
				}
			}
		}
		return $aStats;
	}
}
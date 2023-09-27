<?php
namespace mdf;
class app_router{
	private $__oMdf;
	private $__aApps=[];
	public function __construct(\mdf\mdf $mdf){
		$this->__oMdf=$mdf;
	}
	public function __get(string $key){
		if(\array_key_exists($key,$this->__aApps)) return $this->__aApps[$key];
		include(__DIR__.'/../apps/'.$key.'/.php/'.$key.'.php');
		$sClass='\mdf\apps\\'.$key;
		$this->__aApps[$key]=new $sClass($this->__oMdf,$this->__oMdf->config['apps'][$key]['db']??false);
		return $this->__aApps[$key];
	}
	public function __set(string $key,$value){}
	public function stats(){
		$aStats=[];
		foreach($this->__aApps as $oApp){
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
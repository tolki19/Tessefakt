<?php
namespace tessefakt;
class app{
	protected $_oTessefakt;
	protected $_oApps;
	protected $_aSetup;
	protected $_oLores;
	protected $_oConnectors;
	protected $_oHash;
	protected $_oKey;
	protected $_oReflection;
	public function __construct(\tessefakt $tessefakt,\tessefakt\app_router $apps,array $setup){
		$this->_oTessefakt=$tessefakt;
		$this->_oApps=$apps;
		$this->_aSetup=$setup;
		$this->_oLores=new \tessefakt\lore_router($this->_oTessefakt,$this);
		$this->_oReflection=new \ReflectionClass($this);
	}
	public function __get(string $key){
		switch($key){
			case 'tessefakt': return $this->_oTessefakt;
			case 'apps': return $this->_oApps;
			case 'connectors':
				if(!$this->_aSetup['connectors']) return null;
				if(!$this->_oConnectors) $this->_oConnectors=new \tessefakt\connector_router($this->_oTessefakt,$this,$this->_aSetup['connectors']);
				return $this->_oConnectors;
			case 'hash':
				if(!$this->_aSetup['hash']) return null;
				if(!$this->_oHash) $this->_oHash=new \tessefakt\hash($this->_oTessefakt,$this,$this->_aSetup['hash']);
				return $this->_oHash;
			case 'key':
				if(!$this->_oKey) $this->_oKey=new \tessefakt\key($this->_oTessefakt,$this,[]);
				return $this->_oKey;
			case 'name': return $this->_oReflection->getName();
			case 'dir': return dirname($this->_oReflection->getFileName());
			case 'setup': return $this->_aSetup;
			case 'lores': return $this->_oLores;
		}
		throw new \Exception('Unknown key');
	}
	public function __set(string $key,$value){}
	public function stats(){
		if($this->_oConnectors) return ['db'=>$this->_oConnectors->stats()];
		return ['db'=>['queries'=>0,'time'=>.0]];
	}
}
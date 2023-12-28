<?php
namespace tessefakt;
class library{
	protected $_oTessefakt;
	protected $_oApp;
	protected $_oLibraries;
	protected $_oReflection;
	protected $_aSubs=[];
	public function __construct(\tessefakt $tessefakt,\tessefakt\app $app,\tessefakt\library_router $libraries){
		$this->_oTessefakt=$tessefakt;
		$this->_oApp=$app;
		$this->_oLibraries=$libraries;
		$this->_oReflection=new \ReflectionClass($this);
	}
	public function __get(string $key){
		switch($key){
			case 'tessefakt': return $this->_oTessefakt;
			case 'apps': return $this->_oApp->apps;
			case 'app': return $this->_oApp;
			case 'libraries': return $this->_oLibraries;
			case 'connectors': return $this->_oApp->connectors;
			case 'hash': return $this->_oApp->hash;
			case 'key': return $this->_oApp->key;
			case 'name': return $this->_oReflection->getName();
			case 'dir': return dirname($this->_oReflection->getFileName());
			case 'subs':
				if(!array_key_exists($key,$this->_aSubs)){
					$this->_aSubs[$key]=new ($this->_oReflection->getName().'\\'.$key)($this->_oTessefakt,$this->_oEntrance);
				}
				return $this->_aSubs[$key];
		}
		throw new \Exception('Unknown key');
	}
	public function __set(string $key,$value){}
}
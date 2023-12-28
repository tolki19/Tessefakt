<?php
namespace tessefakt;
class controller{
	protected $_oTessefakt;
	protected $_oEntrance;
	protected $_oControllers;
	protected $_oReflection;
	protected $_aSubs=[];
	public function __construct(\tessefakt $tessefakt,\tessefakt\entrance $entrance,\tessefakt\controller_router $controllers){
		$this->_oTessefakt=$tessefakt;
		$this->_oEntrance=$entrance;
		$this->_oControllers=$controllers;
		$this->_oReflection=new \ReflectionClass($this);
	}
	public function __get(string $key){
		switch($key){
			case 'tessefakt': return $this->_oTessefakt;
			case 'apps': return $this->_oEntrance->apps;
			case 'app': return $this->_oEntrance->app;
			case 'entrances': return $this->_oEntrance->entrances;
			case 'entrance': return $this->_oEntrance;
			case 'controllers': return $this->_oControllers;
			case 'connectors': return $this->_oEntrance->connectors;
			case 'hash': return $this->_oEntrance->_oApp->hash;
			case 'key': return $this->_oEntrance->_oApp->key;
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
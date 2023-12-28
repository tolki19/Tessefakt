<?php
namespace tessefakt;
class controller{
	protected $_oTessefakt;
	protected $_oEntrance;
	protected $_oControllers;
	protected $_oReflection;
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
			case 'hash': return $this->_oEntrance->app->hash;
			case 'key': return $this->_oEntrance->app->key;
			case 'name': return $this->_oReflection->getName();
			case 'dir': return dirname($this->_oReflection->getFileName());
		}
		throw new \Exception('Unknown key');
	}
	public function __set(string $key,$value){}
}
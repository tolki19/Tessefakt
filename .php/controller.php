<?php
namespace tessefakt;
class controller{
	protected $_oTessefakt;
	protected $_oLore;
	protected $_oControllers;
	protected $_oReflection;
	protected $_aSubs=[];
	public function __construct(\tessefakt $tessefakt,\tessefakt\lore $lore,\tessefakt\controller_router $controllers){
		$this->_oTessefakt=$tessefakt;
		$this->_oLore=$lore;
		$this->_oControllers=$controllers;
		$this->_oReflection=new \ReflectionClass($this);
	}
	public function __get(string $key){
		switch($key){
			case 'tessefakt': return $this->_oTessefakt;
			case 'apps': return $this->_oLore->apps;
			case 'app': return $this->_oLore->app;
			case 'lores': return $this->_oLore->lores;
			case 'lore': return $this->_oLore;
			case 'controllers': return $this->_oControllers;
			case 'db': return $this->_oLore->_oApp->db;
			case 'hash': return $this->_oLore->_oApp->hash;
			case 'key': return $this->_oLore->_oApp->key;
			case 'name': return $this->_oReflection->getName();
			case 'dir': return dirname($this->_oReflection->getFileName());
			case 'subs':
				if(!array_key_exists($key,$this->_aSubs)){
					$this->_aSubs[$key]=new ($this->_oReflection->getName().'\\'.$key)($this->_oTessefakt,$this->_oLore);
				}
				return $this->_aSubs[$key];
		}
		throw new \Exception('Unknown key');
	}
	public function __set(string $key,$value){}
}
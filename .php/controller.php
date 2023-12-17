<?php
namespace tessefakt;
class controller{
	protected $_oTessefakt;
	protected $_oLore;
	protected $_oReflection;
	protected $_aControllers=[];
	public function __construct(\tessefakt $tessefakt,\tessefakt\lore $lore){
		$this->_oTessefakt=$tessefakt;
		$this->_oLore=$lore;
		$this->_oReflection=new \ReflectionClass($this);
	}
	public function __get(string $key){
		switch($key){
			case 'tessefakt': return $this->_oTessefakt;
			case 'lore': return $this->_oLore;
			case 'app': return $this->_oLore->_oApp;
			case 'db': return $this->_oLore->_oApp->db;
			case 'hash': return $this->_oLore->_oApp->hash;
			case 'key': return $this->_oLore->_oApp->key;
			case 'name': return $this->_oReflection->getName();
			case 'dir': return dirname($this->_oReflection->getFileName());
			case 'controllers':
				if(!array_key_exists($key,$this->_aControllers)){
					$this->_aControllers[$key]=new ($this->_oReflection->getName().'\\'.$key)($this->_oTessefakt,$this->_oLore);
				}
			return $this->_aControllers[$key];
		}
	}
	public function __set(string $key,$value){}
}
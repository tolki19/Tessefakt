<?php
namespace tessefakt;
class controller_router{
	protected $_oTessefakt;
	protected $_oEntry;
	protected $_aControllers=[];
	public function __construct(\tessefakt $tessefakt,\tessefakt\entry $entry){
		$this->_oTessefakt=$tessefakt;
		$this->_oEntry=$entry;
	}
	public function __get(string $key){
		if(!array_key_exists($key,$this->_aControllers)){
			$this->_aControllers[$key]=new ($this->_oEntry->name.'\\controllers\\'.$key)($this->_oTessefakt,$this->_oEntry,$this);
		}
		return $this->_aControllers[$key];
	}
	public function __set(string $key,$value){}
}
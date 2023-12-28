<?php
namespace tessefakt;
class controller_router{
	protected $_oTessefakt;
	protected $_oEntrance;
	protected $_aControllers=[];
	public function __construct(\tessefakt $tessefakt,\tessefakt\entrance $entrance){
		$this->_oTessefakt=$tessefakt;
		$this->_oEntrance=$entrance;
	}
	public function __get(string $key){
		if(!array_key_exists($key,$this->_aControllers)){
			$this->_aControllers[$key]=new ($this->_oEntrance->name.'\\controllers\\'.$key)($this->_oTessefakt,$this->_oEntrance,$this);
		}
		return $this->_aControllers[$key];
	}
	public function __set(string $key,$value){}
}
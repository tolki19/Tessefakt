<?php
namespace tessefakt;
class controller_router{
	protected $_oTessefakt;
	protected $_oLore;
	protected $_aControllers=[];
	public function __construct(\tessefakt $tessefakt,\tessefakt\lore $lore){
		$this->_oTessefakt=$tessefakt;
		$this->_oLore=$lore;
	}
	public function __get(string $key){
		if(!array_key_exists($key,$this->_aControllers)){
			$this->_aControllers[$key]=new ($this->_oLore->name.'\\controllers\\'.$key)($this->_oTessefakt,$this->_oLore,$this);
		}
		return $this->_aControllers[$key];
	}
	public function __set(string $key,$value){}
}
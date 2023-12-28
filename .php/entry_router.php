<?php
namespace tessefakt;
class entry_router{
	protected $_oTessefakt;
	protected $_oApp;
	protected $_aEntrys=[];
	public function __construct(\tessefakt $tessefakt,\tessefakt\app $app){
		$this->_oTessefakt=$tessefakt;
		$this->_oApp=$app;
	}
	public function __get(string $key){
		if(!array_key_exists($key,$this->_aEntrys)){
			$this->_aEntrys[$key]=new ($this->_oApp->name.'\\entries\\'.$key)($this->_oTessefakt,$this->_oApp,$this);
		}
		return $this->_aEntrys[$key];
	}
	public function __set(string $key,$value){}
}
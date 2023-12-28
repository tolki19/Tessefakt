<?php
namespace tessefakt;
class entrance_router{
	protected $_oTessefakt;
	protected $_oApp;
	protected $_aEntrances=[];
	public function __construct(\tessefakt $tessefakt,\tessefakt\app $app){
		$this->_oTessefakt=$tessefakt;
		$this->_oApp=$app;
	}
	public function __get(string $key){
		if(!array_key_exists($key,$this->_aEntrances)){
			$this->_aEntrances[$key]=new ($this->_oApp->name.'\\entrances\\'.$key)($this->_oTessefakt,$this->_oApp,$this);
		}
		return $this->_aEntrances[$key];
	}
	public function __set(string $key,$value){}
}
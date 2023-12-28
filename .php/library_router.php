<?php
namespace tessefakt;
class library_router{
	protected $_oTessefakt;
	protected $_oApp;
	protected $_aLibraries=[];
	public function __construct(\tessefakt $tessefakt,\tessefakt\app $app){
		$this->_oTessefakt=$tessefakt;
		$this->_oApp=$app;
	}
	public function __get(string $key){
		if(!array_key_exists($key,$this->_aLibraries)){
			$this->_aLibraries[$key]=new ($this->_oApp->name.'\\libraries\\'.$key)($this->_oTessefakt,$this->_oApp,$this);
		}
		return $this->_aLibraries[$key];
	}
	public function __set(string $key,$value){}
}
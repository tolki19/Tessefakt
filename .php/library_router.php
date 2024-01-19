<?php
namespace tessefakt;
class library_router{
	protected $_oTessefakt;
	protected $_oApp;
	protected $_oLibrary;
	protected $_aLibraries=[];
	public function __construct(\tessefakt $tessefakt,\tessefakt\app|null $app=null,\tessefakt\library|null $library=null){
		$this->_oTessefakt=$tessefakt;
		$this->_oApp=$app;
		$this->_oLibrary=$library;
	}
	public function __get(string $key){
		if(!array_key_exists($key,$this->_aLibraries)){
			if(!is_null($this->_oLibrary)){
				$this->_aLibraries[$key]=new ($this->_oLibrary->name.'\\'.$key)($this->_oTessefakt,$this->_oApp,$this);
			}else{
				$this->_aLibraries[$key]=new ($this->_oApp->name.'\\libraries\\'.$key)($this->_oTessefakt,$this->_oApp,$this);
			}
		}
		return $this->_aLibraries[$key];
	}
	public function __set(string $key,$value){}
}
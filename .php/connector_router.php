<?php
namespace tessefakt;
class connector_router{
	protected $_oTessefakt;
	protected $_oApp;
	protected $_aSetup;
	protected $_oConnectors=[];
	public function __construct(\tessefakt\tessefakt $tessefakt,\tessefakt\app $app,array $setup){
		$this->_oTessefakt=$tessefakt;
		$this->_oApp=$app;
		$this->_aSetup=$setup;
	}
	public function __get(string $key){
		if(array_key_exists($key,$this->_oConnectors)) return $this->_oConnectors[$key];
		$this->_oConnectors[$key]=new ('\\tessefakt\\connectors\\'.$this->_aSetup[$key]['type'])($this->_oTessefakt,$this->_oApp,$this->_aSetup[$key]);
		return $this->_oConnectors[$key];
	}
	public function __set(string $key,$value){}
}
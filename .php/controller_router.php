<?php
namespace tessefakt;
class controller_router{
	protected $_oTessefakt;
	protected $_oApp;
	protected $_aControllers=[];
	public function __construct(\tessefakt $tessefakt,\tessefakt\app $app){
		$this->_oTessefakt=$tessefakt;
		$this->_oApp=$app;
	}
	public function __get(string $key){
		if(!array_key_exists($key,$this->_aControllers)){
			$this->_aControllers[$key]=new ('\\tessefakt\\apps\\'.$this->_oApp->name.'\\controllers\\'.$key)($this->_oTessefakt,$this->_oApp);
		}
		return $this->_aControllers[$key];
	}
	public function __set(string $key,$value){}
}
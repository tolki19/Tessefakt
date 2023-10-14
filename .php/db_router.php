<?php
namespace tessefakt;
class db_router{
	protected $_oTessefakt;
	protected $_oApp;
	private $__aSetup;
	private $__oDbs=[];
	public function __construct(\tessefakt\tessefakt $tessefakt,\tessefakt\app $app,array $setup){
		$this->_oTessefakt=$tessefakt;
		$this->_oApp=$app;
		$this->__aSetup=$setup;
	}
	public function __get(string $key){
		if(array_key_exists($key,$this->__oDbs)) return $this->__oDbs[$key];
		$this->__oDbs[$key]=new \tessefakt\dbs\mysqli($this->_oTessefakt,$this,$this->__aSetup[$key]);
		return $this->__oDbs[$key];
	}
	public function __set(string $key,$value){}
}
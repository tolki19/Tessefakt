<?php
namespace tessefakt;
class db_router{
	private $__oTessefakt;
	private $__oApp;
	private $__aCredentials;
	private $__aDbs=[];
	public function __construct(\tessefakt\tessefakt $tessefakt,\tessefakt\app $app,array $credentials){
		$this->__oTessefakt=$tessefakt;
		$this->__oApp=$app;
		$this->__aCredentials=$credentials;
	}
	public function __get(string $key){
		if(array_key_exists($key,$this->__aDbs)) return $this->__aDbs[$key];
		$this->__aDbs[$key]=new \tessefakt\dbs\mysqli($this->__oTessefakt,$this,$this->__aCredentials[$key]);
		return $this->$this->__aDbs[$key];
	}
	public function __set(string $key,$value){}
}
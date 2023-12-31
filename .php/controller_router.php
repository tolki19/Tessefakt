<?php
namespace tessefakt;
class controller_router{
	private $__oTessefakt;
	private $__oApp;
	private $__aControllers=[];
	public function __construct(\tessefakt\tessefakt $tessefakt,\tessefakt\app $app){
		$this->__oTessefakt=$tessefakt;
		$this->__oApp=$app;
	}
	public function __get(string $key){
		if(array_key_exists($key,$this->__aControllers)) return $this->__aControllers[$key];
		include($this->__oApp->dir.\DIRECTORY_SEPARATOR.'controllers'.\DIRECTORY_SEPARATOR.$key.'.php');
		$sClass='\tessefakt\apps\\'.$this->__oApp->name.'\controllers\\'.$key;
		$this->__aControllers[$key]=new $sClass($this->__oTessefakt,$this->__oApp);
		return $this->__aControllers[$key];
	}
	public function __set(string $key,$value){}
}
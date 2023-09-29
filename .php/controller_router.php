<?php
namespace tessefakt;
class controller_router{
	private $__oMdf;
	private $__oApp;
	private $__aControllers=[];
	public function __construct(\tessefakt\tessefakt $tessefakt,app $app){
		$this->__oMdf=$tessefakt;
		$this->__oApp=$app;
	}
	public function __get(string $key){
		if(\array_key_exists($key,$this->__aControllers)) return $this->__aControllers[$key];
		include($this->__oApp->dir.'/controllers/'.$key.'.php');
		$sClass='\tessefakt\apps\\'.$this->__oApp->name.'\controllers\\'.$key;
		$this->__aControllers[$key]=new $sClass($this->__oMdf,$this->__oApp);
		return $this->__aControllers[$key];
	}
	public function __set(string $key,$value){}
}
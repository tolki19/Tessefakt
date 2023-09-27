<?php
namespace mdf;
class controller_router{
	private $__oMdf;
	private $__oApp;
	private $__aControllers=[];
	public function __construct(\mdf\mdf $mdf,app $app){
		$this->__oMdf=$mdf;
		$this->__oApp=$app;
	}
	public function __get(string $key){
		if(\array_key_exists($key,$this->__aControllers)) return $this->__aControllers[$key];
		include($this->__oApp->dir.'/controllers/'.$key.'.php');
		$sClass='\mdf\apps\\'.$this->__oApp->name.'\controllers\\'.$key;
		$this->__aControllers[$key]=new $sClass($this->__oMdf,$this->__oApp);
		return $this->__aControllers[$key];
	}
	public function __set(string $key,$value){}
}
<?php
namespace tessefakt;
class operations{
	private $__oTessefakt;
	private $__oSpace;
	public function __construct(\tessefakt\tessefakt $tessefakt){
		$this->__oTessefakt=$tessefakt;
	}
	public function __get(string $key){
		if(!array_key_exists($key,$this->__oSpace)) throw new \Exception('not before handed');
		return $this->__oSpace[$key];
	}
	public function __set(string $key,$value){
		$this->__oSpace[$key]=$value;
	}
}
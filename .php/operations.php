<?php
namespace mdf;
class operations{
	private $__oMdf;
	private $__oSpace;
	public function __construct(\mdf\mdf $mdf){
		$this->__oMdf=$mdf;
	}
	public function __get(string $key){
		if(!array_key_exists($key,$this->__oSpace)) throw new Exception('not before handed');
		return $this->__oSpace[$key];
	}
	public function __set(string $key,$value){
		$this->__oSpace[$key]=$value;
	}
}
<?php
namespace tessefakt\requests;
class requests{
	protected $__oMdf;
	protected $__aValue;
	protected $__oValue=[];
	public function __construct(\tessefakt\tessefakt $tessefakt){
		$this->__oMdf=$tessefakt;
	}
	public function __get(string $key){
		if(!array_key_exists($key,$this->__aValue)) return null;
		return $this->__aValue[$key];
	}
}

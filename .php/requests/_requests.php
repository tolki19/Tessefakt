<?php
namespace mdf\requests;
class requests{
	protected $__oMdf;
	protected $__aValue;
	protected $__oValue=[];
	public function __construct(\mdf\mdf $mdf){
		$this->__oMdf=$mdf;
	}
	public function __get(string $key){
		if(!array_key_exists($key,$this->__aValue)) return null;
		return $this->__aValue[$key];
	}
}
